<?php

namespace App\Service;

use Google_Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleCalendarService
{
    private $client;

    public function __construct(string $clientId, string $redirectUri)
    {
        $this->client = new Google_Client();
        $this->client->setClientId($clientId);
        $this->client->setRedirectUri($redirectUri);
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setIncludeGrantedScopes(true);
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function fetchAccessToken(string $authorizationCode)
    {
        return $this->client->fetchAccessTokenWithAuthCode($authorizationCode);
    }

    public function createEvent(array $eventData)
    {
        $calendarId='primary';  
        $service = new Calendar($this->client);
        $event = new Event($eventData);
        return $service->events->insert($calendarId, $event);
    }
    public function getEvents()
    {
        $service = new Calendar($this->client);
        $calendarId = 'primary'; // ID du calendrier principal de l'utilisateur
        $events = $service->events->listEvents($calendarId);
    
        return $events->getItems();
    }
    

}
