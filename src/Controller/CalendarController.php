<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GoogleCalendarService;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class CalendarController extends AbstractController
{
  //  #[Route('/calendar', name: 'app_calendar')]
  public function oauthCallback(Request $request, GoogleCalendarService $calendarService): Response
    {
        // Récupérer le code d'autorisation à partir de la requête
        $authorizationCode = $request->query->get('code');

        // Échanger le code d'autorisation contre un jeton d'accès
        $accessToken = $calendarService->fetchAccessToken($authorizationCode);

        // Exemple de données pour créer un événement
        $eventData = [
            'summary' => 'Réunion hebdomadaire',
            'location' => 'Salle de conférence',
            'description' => 'Réunion hebdomadaire pour discuter des progrès du projet.',
            'start' => [
                'dateTime' => '2024-06-07T09:00:00',
                'timeZone' => 'Europe/Paris',
            ],
            'end' => [
                'dateTime' => '2024-06-07T10:00:00',
                'timeZone' => 'Europe/Paris',
            ],
        ];
       
        // Créer un événement dans le calendrier Google
        $createdEvent = $calendarService->createEvent($eventData);

        // Traiter la réponse
        if ($createdEvent) {
            // Événement créé avec succès
            $message = 'Événement créé avec succès.';
        } else {
            // Erreur lors de la création de l'événement
            $message = 'Erreur lors de la création de l\'événement.';
        }

        // Afficher une réponse à l'utilisateur
        return new Response($message);
    }
    public function index(GoogleCalendarService $calendarService, ParameterService $parameterService, MenuService $menuService, TexteService $texteService): Response
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
    $authUrl = $calendarService->getAuthUrl();
    // Rediriger l'utilisateur vers l'URL d'autorisation
    return $this->redirect($authUrl);
    // Récupérer les événements du calendrier
    $events = $calendarService->getEvents();
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
            'parametres'=>$parametres,
             'events'=>$events
        ]);
    }
       
        
   
    
}
