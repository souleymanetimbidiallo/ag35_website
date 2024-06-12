<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\MesImageRepository;
use App\Service\MenuService;
use App\Service\ParameterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServiceRepository;
use App\Service\TexteService;
use Mailgun\Mailgun;
use Mailgun\HttpClient\HttpClientConfigurator;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(
        ParameterService $parameterService,
        Request $request,
        EntityManagerInterface $manager,
        ServiceRepository $serviceRepository,
        MenuService $menuService,
        MesImageRepository $mesImageRepository,
        TexteService $texteService
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, null, [
            'service_repository' => $serviceRepository,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            // Configuration de Mailgun
            $configurator = new HttpClientConfigurator();
            $mailgunKey = $_ENV["MAILGUN_API_KEY"];
            $configurator->setApiKey($mailgunKey);
            $mgClient = new Mailgun($configurator);
            $domain = "sandboxb71804ec757c4da09ddffea0996c7d80.mailgun.org";

            // Contenu de l'email
            $messageContent = $contact->getMessage() . "\n\n" .
                            "Nom: " . $contact->getNom() . "\n" .
                            "Prénom: " . $contact->getPrenom() . "\n" .
                            "Téléphone: " . $contact->getTelephone();

            $params = [
                'from' => $contact->getEmail(),
                'to' => 'hadjasorybintabah@gmail.com',
                'subject' => $contact->getTitre(),
                'text' => $messageContent,
                'html' => nl2br($messageContent) // Convertir les sauts de ligne en balises <br> pour HTML
            ];

            // Envoi de l'email via Mailgun
            $mgClient->messages()->send($domain, $params);

            return $this->redirectToRoute('app_contact');
        }

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
            'lien_donation' => $texteService->getParametreByName('lien_donation')
        ];

        $choices = $serviceRepository->findAllTitres();
        $images = $mesImageRepository->findAll();

        return $this->render('contact.html.twig', [
            'current_menu' => 'contact',
            'parametres'   => $parametres,
            'form' => $form->createView(),
            'choices' => $choices,
            'images' => $images,
        ]);
    }

    /**
     * @Route("/send-contact", name="send-contact")
     */
    public function sendMessage(): Response
    {
        return $this->render('contact.html.twig');
    }
}
