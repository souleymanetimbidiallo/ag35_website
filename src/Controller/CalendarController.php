<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GoogleCalendarService;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CalendarController extends AbstractController
{
  //  #[Route('/calendar', name: 'app_calendar')]
  private $session;

  public function __construct(SessionInterface $session)
  {
      $this->session = $session;
  }

    
    public function index(Request $request,GoogleCalendarService $calendarService, ParameterService $parameterService, MenuService $menuService, TexteService $texteService): Response
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
        
       
     // Vérifier si l'utilisateur est déjà authentifié
    if (!$calendarService->isAuthenticated()) {
        // Si l'utilisateur n'est pas authentifié, rediriger vers l'URL d'autorisation
        $authUrl = $calendarService->getAuthUrl();
        return $this->redirect($authUrl);
     }
   
    // Vérifiez si vous avez obtenu un jeton d'accès valide
    if ($accessToken) {
        // Stockez le jeton d'accès dans la session
        $this->session->set('calendar_access_token', $accessToken);

        // Récupérez les événements du calendrier en utilisant le jeton d'accès
       // $events = $calendarService->getEvents();
         // Stocker les événements dans la session
       //$this->session->set('calendar_events', json_encode($events));
        // Redirigez vers la vue associée au contrôleur CalController
        return $this->redirectToRoute('cal',['accessToken'=>$accessToken]);
    } else {
        // Gérez le cas où l'échange du code contre le jeton n'a pas fonctionné
        return new Response('Erreur lors de l\'échange du code d\'autorisation contre le jeton d\'accès.');
    }
    
    return $this->render('calendar/index.html.twig', [
        'controller_name' => 'CalendarController',
        'parametres' => $parametres,
        'events' => $events,
    ]);
}
    
}
