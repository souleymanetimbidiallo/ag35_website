<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonController extends AbstractController
{
    /**
     * @Route("/don", name="don")
     */
    public function don(): Response
    {
        return $this->render('don.html.twig');
    }
}
