<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsEventController extends AbstractController
{
    /**
     * @Route("/details_event", name="app_details_event")
     */
    public function index(): Response
    {
        // Ancienne URL (/details_event?titre=...) : les événements ont désormais leur propre page.
        return $this->redirectToRoute('app_evenements', [], Response::HTTP_MOVED_PERMANENTLY);
    }
}
