<?php

namespace App\Controller;

use App\Service\ParameterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdhesionController extends AbstractController
{
    /**
     * @Route("/adhesion", name="app_adhesion") 
     */
    public function index(ParameterService $parameterService): Response
    {

        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'site_logo' => $parameterService->getSiteLogo(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp()
        ];

        return $this->render('adhesion.html.twig', [
            'current_menu' => 'adhesion',
            'parametres'   => $parametres
        ]);
    }
}
