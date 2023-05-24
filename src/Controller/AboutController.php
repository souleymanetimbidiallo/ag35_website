<?php

namespace App\Controller;

use App\Service\ParameterService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */
    public function about(ParameterService $parameterService): Response
    {


        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp()
        ];


        return $this->render('about.html.twig', [
            'current_menu' => 'about',
            'parametres' => $parametres
        ]);
    }
}
