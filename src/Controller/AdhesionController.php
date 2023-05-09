<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdhesionController extends AbstractController
{
    /**
     * @Route("/don", name="don") 
     */
    public function index(): Response
    {
        return $this->render('adhesion.html.twig');
    }
}
