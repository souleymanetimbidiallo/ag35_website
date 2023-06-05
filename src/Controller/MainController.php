<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Repository\TemoinRepository;
use App\Service\ParameterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function index(ParameterService $parameterService, ServiceRepository $serviceRepository, TemoinRepository $temoinRep): Response
    {

        $parametres = [
            'site_name' => $parameterService->getParametreByName("site_name"),
            'site_logo' => $parameterService->getSiteLogo(),
            'address' => $parameterService->getParametreByName("site_adresse"),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
            'asso_img1' => $parameterService->getAssoImg1(),
            'asso_img2' => $parameterService->getAssoImg2(),
            'asso_img3' => $parameterService->getAssoImg3(),
            'nom_association' => $parameterService->getNomAsso(),


        ];
        $services = $serviceRepository->findAll();
        $temoins = $temoinRep->findAll();


        return $this->render('index.html.twig', [
            'current_menu' => 'accueil',
            'parametres' => $parametres,
            'services' => $services,
            'temoins' => $temoins

        ]);
    }
}
