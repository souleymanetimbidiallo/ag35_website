<?php

namespace App\Controller;

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
    public function index(ParameterService $parameterService): Response
    {
        $parameterService->setBodyText1("Organiser, harmoniser, communiquer et synchroniser les acvités et les projets sociaux, culturels et sportifs de ses membres et de ses partenaires.");

        $parametres = [
            'site_name' => $parameterService->getParametreByName("site_name"),
            'address' => $parameterService->getParametreByName("site_adresse"),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
            'asso_img1' => $parameterService->getAssoImg1(),
            //'asso_img2' => $parameterService->getAssoImg2(),
            //'asso_img3' => $parameterService->getAssoImg3()
            'body_text1' => $parameterService->getBodyText1(),
            'body_text2' => $parameterService->getBodyText2(),
            'body_text3' => $parameterService->getBodyText3(),
            'body_text4' => $parameterService->getBodyText4(),
            'nom_asso' => $parameterService->getNomAsso(),
            'sigle_nom_asso' => $parameterService->getSigleNomAsso(),
            'temoin1' => $parameterService->getTemoin1(),
            'temoin2' => $parameterService->getTemoin2(),
            'temoin3' => $parameterService->getTemoin3(),
            'temoin4' => $parameterService->getTemoin4(),
            'temoin1_nom' => $parameterService->getTemoin1Nom(),
            'temoin2_nom' => $parameterService->getTemoin2Nom(),
            'temoin3_nom' => $parameterService->getTemoin3Nom(),
            'temoin4_nom' => $parameterService->getTemoin4Nom(),
            'temoin1_prof' => $parameterService->getTemoin1Prof(),
            'temoin2_prof' => $parameterService->getTemoin2Prof(),
            'temoin3_prof' => $parameterService->getTemoin3Prof(),
            'temoin4_prof' => $parameterService->getTemoin4Prof()
        ];


        return $this->render('index.html.twig', [
            'current_menu' => 'accueil',
            'parametres' => $parametres

        ]);
    }
}
