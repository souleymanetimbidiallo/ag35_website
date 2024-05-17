<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\MesImageRepository;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsEventController extends AbstractController
{
    /**
     * @Route("/details_event", name="app_details_event")
     */
    public function index(ParameterService $parameterService, EvenementRepository $evenementRepository, MesImageRepository $mesImageRepository, MenuService $menuService): Response
    {

        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
            'nom_association' => $parameterService->getParametreByName("nom_association"),
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
            'accueil_video' => $parameterService->getTitre_accueil_video(),
            'accueil_event' => $parameterService->getTitre_accueil_event(),
            'accueil_temoin' => $parameterService->getTitre_accueil_temoin(),
            'nos_valeurs' => $parameterService->getParametreByName("nos_valeurs"),
            'texte_nos_valeurs' => $parameterService->getParametreByName("texte_nos_valeurs"),
            'nos_gouvernances' => $parameterService->getParametreByName("nos_gouvernances"),
            'texte_nos_gouvernances' => $parameterService->getParametreByName("texte_nos_gouvernances"),
            'nos_partenaires' => $parameterService->getParametreByName("nos_partenaires"),
            'texte_nos_partenaires' => $parameterService->getParametreByName("texte_nos_partenaires"),
            'nous_sommes' => $parameterService->getParametreByName("site_nous_sommes"),
            'lien_billeterie' => $parameterService->getParametreByName("lien_billeterie"),
            'lien_donation' => $parameterService->getParametreByName('lien_donation')

        ];

        $evenements = $evenementRepository->findAll();
        $images = $mesImageRepository->findAll();

        return $this->render('details_event.html.twig', [
            'current_menu' => 'details_event',
            'parametres'   => $parametres,
            'evenements' => $evenements,
            'images' => $images
        ]);
    }
}
