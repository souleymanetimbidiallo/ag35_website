<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(MembreRepository $membreRepository): Response
    {
        $membresBureau = $membreRepository->findByCustomQuery();
        return $this->render('about.html.twig', [
            'bureau' => $membresBureau
        ]);
    }
}
