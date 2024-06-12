<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

class ApiProvider
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchData(callable $fetchFunction): array
    {
        return $fetchFunction();
    }

    public function compareData(array $oldData, array $newData): array
    {
        $differences = array_udiff($newData, $oldData, function ($a, $b) {
            return $a['id'] <=> $b['id'];
        });

        return $differences;
    }
}
