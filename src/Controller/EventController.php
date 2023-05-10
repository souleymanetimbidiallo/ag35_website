<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/evenements", name="app_evenements")
     */
    public function index(): Response
    {
        return $this->render('event.html.twig', [
            'current_menu' => 'evenements'
        ]);
    }
}
