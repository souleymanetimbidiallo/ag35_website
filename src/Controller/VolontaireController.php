<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolontaireController extends AbstractController
{
    #[Route('/volontaire', name: 'app_volontaire')]
    public function index(): Response
    {
        return $this->render('volontaire/index.html.twig', [
            'controller_name' => 'VolontaireController',
        ]);
    }
}
