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

class NewslettersController extends AbstractController
{
    private $evenementRepository;

    public function __construct(EvenementRepository $evenementRepository)
    {
        $this->evenementRepository = $evenementRepository;
    }

    /**
 * @Route("/inscription-newsletter", name="inscription_newsletter", methods={"POST"})
 */
public function inscriptionNewsletter(Request $request, SessionInterface $session): Response
{
    // Récupération des données du formulaire
    $firstName = $request->request->get('firstName');
    $lastName = $request->request->get('lastName');
    $email = $request->request->get('email');

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
     * @Route("/envoyer", name="envoyer", methods={"GET","POST"})
     */
    public function envoyerNewsletter(Request $request, MailerInterface $mailer, ParameterService $parameterService, MenuService $menuService, MesImageRepository $mesImageRepository, TexteService $texteService): Response
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
            'menu_contact' => $menuService->getContact(),
            'menu_evenement' => $menuService->getEvenement(),
            'menu_actualite' => $menuService->getActualite(),
            'menu_guide' => $menuService->getGuide(),
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

        // Récupération des événements
        $evenements = $this->evenementRepository->findAll();

        // Si le formulaire est soumis
        if ($request->isMethod('POST')) {
            // Récupération des données du formulaire
            $evenementId = $request->request->get('evenement');
            $contenuNewsletter = $request->request->get('contenu');

            // Récupération de l'événement sélectionné
            $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($evenementId);

            // Création d'une instance du configurateur HttpClientConfigurator
            $configurator = new HttpClientConfigurator();
            $configurator->setApiKey('efb1de3e84dbbd314eee157db62f73e7-ed54d65c-4a880fb8');

            // Création d'une instance du client Mailgun avec le configurateur
            $mgClient = new Mailgun($configurator);

            // Domaine Mailgun
            $domain = "sandboxb71804ec757c4da09ddffea0996c7d80.mailgun.org";

            // Récupération des abonnés à la newsletter
            $abonnes = $this->getDoctrine()->getRepository(Newsletter::class)->findAll();

            foreach ($abonnes as $abonne) {
                // Construction du contenu du mail
                $contenuMail = sprintf("Bonjour %s %s,\n\n[image]\n%s\n%s\n%s\n%s", 
                    $abonne->getFirstName(), 
                    $abonne->getLastName(), 
                    $evenement->getCommentaire(), 
                    $evenement->getPrix(), 
                    $evenement->getAdresse(), 
                    $evenement->getDateDebut()->format('Y-m-d H:i:s')
                );

                // Envoi de l'e-mail via Mailgun
                $mgClient->messages()->send($domain, [
                    'from' => 'hadjasorybintabah@gmail.com',
                    'to' => $abonne->getEmail(),
                    'subject' => $evenement->getTitre(),
                    
                    'text' => $contenuMail,
                ]);
            }

            // Redirection vers une page de confirmation après envoi des e-mails
            return $this->redirectToRoute('envoyer');
        }

        // Affichage du formulaire dans la vue envoyermail.html.twig
        return $this->render('envoyermail.html.twig', [
            'evenements' => $evenements,
            'parametres'   => $parametres
        ]);
    }

    /**
     * @Route("/confirmation-envoi", name="confirmation_envoi")
     */
    public function confirmationEnvoi(): Response
    {
        return $this->render('envoyermail.html.twig');
    }
}



