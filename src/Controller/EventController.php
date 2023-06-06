<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Service\ParameterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/evenements", name="app_evenements")
     */
    public function index(ParameterService $parameterService, EvenementRepository $evenementRepository): Response
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

        $evenements = $evenementRepository->findAll();

        return $this->render('event.html.twig', [
            'current_menu' => 'evenements',
            'parametres'   => $parametres,
            'evenements' => $evenements
        ]);
    }
}
