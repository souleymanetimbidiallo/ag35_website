<?php
// src/EventListener/FetchDataListener.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use App\Service\HelloAssoService;

class FetchDataListener
{
    private $helloAssoService;

    public function __construct(HelloAssoService $helloAssoService)
    {
        $this->helloAssoService = $helloAssoService;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Call the fetchDataPeriodically method
        $this->helloAssoService->fetchDataPeriodically();
    }
}
