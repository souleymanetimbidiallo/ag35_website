<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\ServiceRepository;
use App\Repository\TemoinRepository;
use App\Service\MenuService;
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

    public function index(ParameterService $parameterService, ServiceRepository $serviceRepository, TemoinRepository $temoinRep, EvenementRepository $evenementRepository, MenuService $menuService): Response
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
            'nom_association' => $parameterService->getParametreByName("nom_association"),
            'menu_accueil' => $menuService->getAccueil(),
            'menu_apropos' => $menuService->getApropos(),
            'menu_activite' => $menuService->getActivite(),
            'menu_multimedia' => $menuService->getMultimedia(),
            'menu_donation' => $menuService->getDonation(),
            'menu_adhesion' => $menuService->getAdhesion(),
            'menu_contact' => $menuService->getContact(),
            'menu_evenement' => $menuService->getEvenement(),
            'menu_actualite' => $menuService->getActualite(),
            'menu_guide' => $menuService->getGuide(),
            'accueil_video' => $parameterService->getTitre_accueil_video(),
            'accueil_event' => $parameterService->getTitre_accueil_event(),
            'accueil_temoin' => $parameterService->getTitre_accueil_temoin(),
            'nos_valeurs' => $parameterService->getParametreByName("nos_valeurs"),
            'texte_nos_valeurs' => $parameterService->getParametreByName("texte_nos_valeurs"),
            'nos_gouvernances' => $parameterService->getParametreByName("nos_gouvernances"),
            'texte_nos_gouvernances' => $parameterService->getParametreByName("texte_nos_gouvernances"),
            'nos_partenaires' => $parameterService->getParametreByName("nos_partenaires"),
            'texte_nos_partenaires' => $parameterService->getParametreByName("texte_nos_partenaires"),
            'nous_sommes' => $parameterService->getParametreByName("site_nous_sommes")



        ];
        $services = $serviceRepository->findAll();
        $temoins = $temoinRep->findAll();
        $evenements = $evenementRepository->findAll();


        return $this->render('index.html.twig', [
            'current_menu' => 'accueil',
            'parametres' => $parametres,
            'services' => $services,
            'temoins' => $temoins,
            'evenements' => $evenements

        ]);
    }
}
