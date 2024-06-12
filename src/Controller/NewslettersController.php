<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\EvenementRepository;
use App\Entity\Newsletter;
use App\Entity\Evenement;
use Mailgun\Mailgun;
use Mailgun\HttpClient\HttpClientConfigurator;
use App\Service\ParameterService;
use App\Service\MenuService;
use App\Repository\MesImageRepository;
use App\Service\TexteService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repository\NewsletterRepository;
use App\Repository\CategoriesujetRepository;
use App\Repository\AdhesionsRepository;
use App\Entity\Adhesions;
use App\Entity\Categoriesujet;


class NewslettersController extends AbstractController
{
    private $newsletterRepository;

    public function __construct(NewsletterRepository $newsletterRepository)
    {
        $this->newsletterRepository = $newsletterRepository;
    }
    /**
 * @Route("/inscription-newsletter", name="inscription_newsletter", methods={"POST"})
 */
public function inscriptionNewsletter(Request $request, SessionInterface $session): Response
{
// Récupération des données du formulaire
$firstName = $request->request->get('modalFirstName');
$lastName = $request->request->get('modalLastName');
$email = $request->request->get('email');


    // Vérifier si les champs prénom et nom de famille sont vides
    if (empty($firstName) || empty($lastName)) {
        // Afficher un message d'erreur et rediriger l'utilisateur
        $session->getFlashBag()->add('error', 'Veuillez remplir tous les champs.');
        return $this->redirect($request->headers->get('referer'));
    }

    // Vérifier si l'email existe déjà dans la base de données
    $existingSubscriber = $this->newsletterRepository->findOneBy(['email' => $email]);

    // Si l'email existe déjà, afficher un message d'erreur et rediriger l'utilisateur
    if ($existingSubscriber) {
        $session->getFlashBag()->add('error', 'Vous êtes déjà inscrit à la newsletter.');
        return $this->redirect($request->headers->get('referer'));
    }

    // Création d'une nouvelle instance de l'entité Newsletter
    $newsletter = new Newsletter();
    $newsletter->setFirstName($firstName);
    $newsletter->setLastName($lastName);
    $newsletter->setEmail($email);

    // Gestion de l'enregistrement dans la base de données
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($newsletter);
    $entityManager->flush();

    // Ajout d'un message flash pour indiquer que l'inscription est réussie
    $session->getFlashBag()->add('success', 'Inscription à la newsletter réussie !');

    // Redirection vers la page précédente (referer)
    return $this->redirect($request->headers->get('referer'));
}


/**
 * @Route("/envoyer", name="envoyer_newsletter", methods={"GET","POST"})
 */
public function envoyerNewsletter(Request $request, MailerInterface $mailer, ParameterService $parameterService, MenuService $menuService, MesImageRepository $mesImageRepository, TexteService $texteService, CategoriesujetRepository $categoriesujetRepository, AdhesionsRepository $adhesionsRepository): Response
{
    $parametres = [
        'site_name' => $parameterService->getSiteName(),
        'nom_association' => $parameterService->getParametreByName("nom_association"),
        'address' => $parameterService->getSiteAdresse(),
        'email' => $parameterService->getSiteEmail(),
        'telephone' => $parameterService->getSiteTelephone(),
        'lien_page_fb' => $parameterService->getLienPageFb(),
        'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
        'lien_whatsApp' => $parameterService->getLienWhatsApp(),
        'menu_accueil' => $menuService->getAccueil(),
        'menu_apropos' => $menuService->getApropos(),
        'menu_activite' => $menuService->getActivite(),
        'menu_multimedia' => $menuService->getMultimedia(),
        'menu_donation' => $menuService->getDonation(),
        'menu_adhesion' => $menuService->getAdhesion(),
        'menu_hebergement' => $menuService->getHebergement(),
        'menu_contact' => $menuService->getContact(),
        'menu_evenement' => $menuService->getEvenement(),
        'menu_actualite' => $menuService->getActualite(),
        'menu_guide' => $menuService->getGuide(),
        'menu_volontariat' => $menuService->getVolontariat(),
        'nos_valeurs' => $parameterService->getParametreByName("nos_valeurs"),
        'texte_nos_valeurs' => $parameterService->getParametreByName("texte_nos_valeurs"),
        'nos_gouvernances' => $parameterService->getParametreByName("nos_gouvernances"),
        'texte_nos_gouvernances' => $parameterService->getParametreByName("texte_nos_gouvernances"),
        'nos_partenaires' => $parameterService->getParametreByName("nos_partenaires"),
        'texte_nos_partenaires' => $parameterService->getParametreByName("texte_nos_partenaires"),
        'nous_sommes' => $parameterService->getParametreByName("site_nous_sommes"),
        'lien_actualite' => $parameterService->getParametreByName("lien_actualite"),
        'texte_actu' => $texteService->getParametreByName('texte_actu'),
        'lien_donation' => $texteService->getParametreByName('lien_donation')
    ];

    $images = $mesImageRepository->findAll();

    // Récupération des abonnés à la newsletter
    $abonnes = $this->newsletterRepository->findAll();
    $categories = $categoriesujetRepository->findAll();
    $adherants = $adhesionsRepository->findAll();

    if ($request->isMethod('POST')) {
        // Récupération des données du formulaire
        $categorieId = $request->request->get('categorie');
        $sujetUser = $request->request->get('sujet');
        $contenu = $request->request->get('contenu');
        $listeDiffusion = $request->request->get('liste_diffusion', []);
        $categorie = $categoriesujetRepository->find($categorieId);
        $categorieSujet = $categorie->getSubject();

        $sujet = $categorieSujet . ': ' . $sujetUser;

        // Traitement de la pièce jointe s'il y en a une
        $pieceJointe = $request->files->get('piece_jointe');
        $pieceJointePath = null;

        if ($pieceJointe instanceof UploadedFile) {
            // Déplacer la pièce jointe vers le dossier des pièces jointes
            $pieceJointePath = $this->moveUploadedFile($pieceJointe);
        }

        // Création d'une instance du configurateur HttpClientConfigurator
        $configurator = new HttpClientConfigurator();
        $mailgunkey = $_ENV["MAILGUN_API_KEY"];
        $configurator->setApiKey($mailgunkey);

        // Création d'une instance du client Mailgun avec le configurateur
        $mgClient = new Mailgun($configurator);

        // Domaine Mailgun
        $domain = "sandboxb71804ec757c4da09ddffea0996c7d80.mailgun.org";

        // Liste des destinataires
        $destinataires = [];

        // Ajout des abonnés à la liste des destinataires
        if (in_array('newsletter', $listeDiffusion)) {
            foreach ($abonnes as $abonne) {
                $destinataires[] = [
                    'email' => $abonne->getEmail(),
                    'firstName' => $abonne->getFirstName(),
                    'lastName' => $abonne->getLastName()
                ];
            }
        }

        // Ajout des adhérants à la liste des destinataires
        if (in_array('adherants', $listeDiffusion)) {
            foreach ($adherants as $adherant) {
                $destinataires[] = [
                    'email' => $adherant->getEmail(),
                    'firstName' => $adherant->getnom(),
                    'lastName' => $adherant->getprenom()
                ];
            }
        }

        foreach ($destinataires as $destinataire) {
            // Construction du contenu du mail
            $contenuMail = sprintf("Bonjour %s %s,\n\n%s", 
                $destinataire['firstName'], 
                $destinataire['lastName'], 
                $contenu
            );
            // Attachez la pièce jointe à l'e-mail si elle existe
            $attachment = null;
            if ($pieceJointePath !== null) {
                // Créez un tableau avec les détails de la pièce jointe
                $attachment = [
                    'filePath' => $pieceJointePath,
                    'filename' => $pieceJointe->getClientOriginalName()
                ];
            }

            // Construction des paramètres de l'e-mail
            $params = [
                'from' => 'hadjasorybintabah@gmail.com',
                'to' => $destinataire['email'],
                'subject' => $sujet,
                'text' => $contenuMail,
            ];

            // Ajoutez la pièce jointe aux paramètres de l'e-mail si elle existe
            if ($attachment !== null) {
                $params['attachment'] = [
                    [
                        'filePath' => $attachment['filePath'],
                        'filename' => $attachment['filename']
                    ]
                ];
            }

            // Envoi de l'e-mail via Mailgun
            $mgClient->messages()->send($domain, $params);
        }

        return $this->redirectToRoute('envoyer_newsletter');
    }

    return $this->render('envoyermail.html.twig', [
        'parametres' => $parametres,
        'images' => $images,
        'categories' => $categories,
        'abonnes' => $abonnes,
        'adherants' => $adherants
    ]);
}
    /**
     * @Route("/confirmation-envoi", name="confirmation_envoi")
     */
    public function confirmationEnvoi(): Response
    {
        return $this->render('envoyermail.html.twig');
    }

        /**
     * Déplacer le fichier téléchargé vers le dossier des pièces jointes.
     *
     * @param UploadedFile $file
     * @return string Chemin de la pièce jointe déplacée
     */
    private function moveUploadedFile(UploadedFile $file): ?string
    {
        $uploadsDirectory = $this->getParameter('uploads_directory');
        $fileName = uniqid().'.'.$file->guessExtension();
    
        try {
            $file->move($uploadsDirectory, $fileName);
            return $uploadsDirectory.'/'.$fileName;
        } catch (FileException $e) {
            return null;
        }
    }

}



