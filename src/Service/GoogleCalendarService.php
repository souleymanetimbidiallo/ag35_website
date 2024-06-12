<?php

namespace App\Service;

use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google_Service_Calendar;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GoogleCalendarService
{
    
    private $client;
    
    public function __construct(string $clientId, string $redirectUri,string $scope,string $authConfig,string $apiKey)
    {
        $this->client = new Google_Client();
        $this->client->setClientId($clientId);
        $this->client->setRedirectUri($redirectUri);
        $this->client->setScopes($scope);
        $this->client->setDeveloperKey($apiKey);
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setIncludeGrantedScopes(true);
        $this->client->setAuthConfig($authConfig);
        $httpClient = $this->client->authorize();
     
       
    }
    public function getClient()
{
    return $this->client;
}


    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }
    public function isAuthenticated()
    {
        return !$this->client->isAccessTokenExpired();
    }
    public function fetchAccessToken(string $authorizationCode)
    {
    $accessToken = $this->client->fetchAccessTokenWithAuthCode($authorizationCode);
   
         return $accessToken;
    }


    public function getEvents(){
        $service = new Google_Service_Calendar($this->client);
        $calendarId = 'fatouthioro24@gmail.com';
        $events = $service->events->listEvents($calendarId);
    
        $allEvents = [];
    
        while(true) {
            foreach ($events->getItems() as $event) {
                // Ajouter chaque événement à un tableau
                $allEvents[] = $event;
            }
            $pageToken = $events->getNextPageToken();
            if ($pageToken) {
                $optParams = array('pageToken' => $pageToken);
                $events = $service->events->listEvents('primary', $optParams);
            } else {
                // Si pas de jeton de page, sortir de la boucle
                break;
            }
        }
    dd($allEvents);
        // Retourner tous les événements récupérés
        return $allEvents;
    }
    
   
}