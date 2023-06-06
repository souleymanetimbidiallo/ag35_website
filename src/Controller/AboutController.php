<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use App\Repository\ParamImageRepository;
use App\Repository\ValeurRepository;
use App\Service\MenuService;
use App\Service\ParameterService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about")
     */

    public function index(ParameterService $parameterService, MembreRepository $membreRepository, ValeurRepository $valeurRep, ParamImageRepository $paramImageRepository): Response
    {

        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'nom_association' => $parameterService->getParametreByName("nom_association"),
            'site_logo' => $parameterService->getSiteLogo(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
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
            'nos_valeurs' => $parameterService->getParametreByName("nos_valeurs"),
            'texte_nos_valeurs' => $parameterService->getParametreByName("texte_nos_valeurs"),
            'nos_gouvernances' => $parameterService->getParametreByName("nos_gouvernances"),
            'texte_nos_gouvernances' => $parameterService->getParametreByName("texte_nos_gouvernances"),
            'nos_partenaires' => $parameterService->getParametreByName("nos_partenaires"),
            'texte_nos_partenaires' => $parameterService->getParametreByName("texte_nos_partenaires"),
            'nous_sommes' => $parameterService->getParametreByName("site_nous_sommes")
        ];


        $membresBureau = $membreRepository->findByCustomQuery();
        $valeurs = $valeurRep->findAll();
        $partenaires = $paramImageRepository->findAll();


        return $this->render('about.html.twig', [
            'current_menu' => 'about',
            'parametres' => $parametres,
            'bureau' => $membresBureau,
            'valeurs' => $valeurs,
            'partenaires' => $partenaires
        ]);
    }
}
