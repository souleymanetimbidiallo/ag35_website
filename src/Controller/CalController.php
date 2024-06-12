<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use App\Service\GoogleCalendarService;
use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class CalController extends AbstractController
{
   # #[Route('/cal', name: 'app_cal')]
   
public function __construct(SessionInterface $session)
{
    $this->session = $session;
}

    public function index(Request $request,SessionInterface $session,GoogleCalendarService $calendarService, ParameterService $parameterService, MenuService $menuService, TexteService $texteService): Response
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
            'lien_donation' => $texteService->getParametreByName('lien_donation')
        ];
         // Récupérer les événements de la session
     //  $events = $this->session->get('calendar_events', []);
    
     $accessToken=$request->query->get('code');
     //dd($accessToken);
     $events = $calendarService->getEvents();


       // Afficher les événements pour débogage
        //dd($events);

       // Rendre la vue
       return $this->render('cal/index.html.twig', [
           'controller_name' => 'CalController',
           'parametres' => $parametres,
           'events'=>$events,
          
       ]);
    }
    
}
