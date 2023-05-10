<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonController extends AbstractController
{
    /**
     * @Route("/don", name="app_don")
     */
    public function index(): Response
    {
        return $this->render('don.html.twig', [
            'current_menu' => 'don'
        ]);
    }
}
