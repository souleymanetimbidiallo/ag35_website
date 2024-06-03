<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class HelloAssoService
{
    private $client;
    private $apiUrl;
    private $clientId;
    private $clientSecret;

    public function __construct(HttpClientInterface $client, string $apiUrl, string $clientId, string $clientSecret)
    {
        $this->client = $client;
        $this->apiUrl = rtrim($apiUrl, '/') . '/';
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    private function authenticate()
    {
        $url = 'https://api.helloasso.com/oauth2/token';
        
        try {
            $response = $this->client->request('POST', $url, [
                'body' => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = $response->toArray();
            return $data['access_token'];
        } catch (TransportExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface $e) {
            throw new \RuntimeException('Authentication failed: ' . $e->getMessage());
        }
    }

    public function getDon(): array
    {
        $token = $this->authenticate();

        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'organizations/association-guineenne-d-ile-et-vilaine-ag35/forms/Donation/1/items',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return $response->toArray();
    }
    public function getAdhesion(): array
    {
        $token = $this->authenticate();

        $response = $this->client->request(
            'GET',
            $this->apiUrl . 'organizations/association-guineenne-d-ile-et-vilaine-ag35/forms/Membership/adhesion-a-ag35/items',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return $response->toArray();
    }
}