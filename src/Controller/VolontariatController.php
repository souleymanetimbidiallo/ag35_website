<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use App\Repository\MesImageRepository;
use App\Repository\VolontariatRepository;


class VolontariatController extends AbstractController
{
  //  #[Route('/volontariat', name: 'app_volontariat')]
    public function index(ParameterService $parameterService, MenuService $menuService, VolontariatRepository $volontariatRepository, TexteService $texteService): Response
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
            'texte_guide' => $texteService->getParametreByName('texte_guide'),
            'lien_donation' => $parameterService->getParametreByName('lien_donation')
        ];

       
        $volontariats = $volontariatRepository->findAll(Volontariat::class);
        return $this->render('/volontariat/volontariat.html.twig', [
            'current_menu' => 'volontariat',
            'parametres'   => $parametres,
            'volontariats'=>$volontariats,
           
        ]);
    }


}
