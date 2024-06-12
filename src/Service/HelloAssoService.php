<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Repository\AdhesionsRepository;
use App\Entity\Adhesions;

class HelloAssoService
{
    private $client;
    private $apiUrl;
    private $clientId;
    private $clientSecret;
    private $adhesionsRepository;

    public function __construct(
        HttpClientInterface $client,
        string $apiUrl,
        string $clientId,
        string $clientSecret,
        AdhesionsRepository $adhesionsRepository
    ) {
        $this->client = $client;
        $this->apiUrl = rtrim($apiUrl, '/') . '/';
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->adhesionsRepository = $adhesionsRepository;
    }

    private function authenticate(): string
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
        } catch (\Exception $e) {
            throw new \RuntimeException('Authentication failed: ' . $e->getMessage());
        }
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

    public function syncAdhesions(): void
    {
        $adhesions = $this->getAdhesion();

        foreach ($adhesions['data'] as $adhesionData) {
            $existingAdhesion = $this->adhesionsRepository->findOneBy(['email' => $adhesionData['payer']['email']]);

            if (!$existingAdhesion) {
                $adhesion = new Adhesions();
                $adhesion->setNom($adhesionData['payer']['firstName'] ?? '');
                $adhesion->setPrenom($adhesionData['payer']['lastName'] ?? '');
                $adhesion->setEmail($adhesionData['payer']['email'] ?? '');
                $adhesion->setTarif($adhesionData['name'] ?? '');
                $adhesion->setMontant($adhesionData['amount'] ?? '');
                $adhesion->setType($adhesionData['type'] ?? '');
                $adhesion->setDate(new \DateTime($adhesionData['order']['date'] ?? 'now'));

                $this->adhesionsRepository->save($adhesion, true);
            }
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
}
