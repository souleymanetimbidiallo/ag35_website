<?php

namespace App\Controller;

use App\Service\ParameterService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonController extends AbstractController
{
    /**
     * @Route("/don", name="app_don")
     */
    public function index(ParameterService $parameterService): Response
    {

        $site_name = "soul";
        $parameterService->setSiteName($site_name);

        $parametres = [
            'site_name' => $parameterService->getSiteName()
        ];

        return $this->render('don.html.twig', [
            'current_menu' => 'don',
            'parametres' => $parametres
        ]);
    }
}
