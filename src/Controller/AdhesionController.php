<?php

namespace App\Controller;

use App\Repository\MesImageRepository;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdhesionController extends AbstractController
{
    /**
     * @Route("/adhesion", name="app_adhesion") 
     */
    public function index(ParameterService $parameterService, MenuService $menuService, MesImageRepository $mesImageRepository, TexteService $texteService): Response
    {

        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'nom_association' => $parameterService->getParametreByName("nom_association"),
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
            'menu_hebergement' => $menuService->getHebergement(),
            'menu_contact' => $menuService->getContact(),
            'menu_evenement' => $menuService->getEvenement(),
            'menu_actualite' => $menuService->getActualite(),
            'menu_guide' => $menuService->getGuide(),
            'menu_volontariat' => $menuService->getVolontariat(),
            'nos_valeurs' => $parameterService->getParametreByName("nos_valeurs"),
            'texte_nos_valeurs' => $parameterService->getParametreByName("texte_nos_valeurs"),
            'nos_gouvernances' => $parameterService->getParametreByName("nos_gouvernances"),
            'texte_nos_gouvernances' => $parameterService->getParametreByName("texte_nos_gouvernances"),
            'nos_partenaires' => $parameterService->getParametreByName("nos_partenaires"),
            'texte_nos_partenaires' => $parameterService->getParametreByName("texte_nos_partenaires"),
            'nous_sommes' => $parameterService->getParametreByName("site_nous_sommes"),
            'lien_adhesion' => $parameterService->getParametreByName("lien_adhesion"),
            'texte_adhesion' => $texteService->getParametreByName('texte_adhesion'),
            'lien_donation' => $texteService->getParametreByName('lien_donation')

        ];
        $images = $mesImageRepository->findAll();

        return $this->render('adhesion.html.twig', [
            'current_menu' => 'adhesion',
            'parametres'   => $parametres,
            'images' => $images
        ]);
    }
}
