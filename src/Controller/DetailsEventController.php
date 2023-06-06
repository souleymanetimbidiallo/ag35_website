<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Service\ParameterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsEventController extends AbstractController
{
    /**
     * @Route("/details_event", name="app_details_event")
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

        return $this->render('details_event.html.twig', [
            'current_menu' => 'details_event',
            'parametres'   => $parametres,
            'evenements' => $evenements
        ]);
    }
}
