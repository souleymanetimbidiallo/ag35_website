<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HelloAssoService;
use App\Service\MenuService;
use App\Service\ParameterService;
use App\Service\TexteService;
use App\Repository\AdhesionsRepository;
use App\Entity\Adhesions;

class HelloAssoAPIController extends AbstractController
{
    /**
     * @Route("/hello/asso", name="hello_asso")
     */
    #[Route('/admin')]
    public function index(HelloAssoService $helloAsso, ParameterService $parameterService, MenuService $menuService, TexteService $texteService, AdhesionsRepository $adhesionsRepository): Response
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
            'lien_donation' => $texteService->getParametreByName('lien_donation')
        ];

        $adhesions = $helloAsso->getAdhesion();

        foreach ($adhesions['data'] as $adhesionData) {
            $existingAdhesion = $adhesionsRepository->findOneBy(['email' => $adhesionData['payer']['email']]);

            if (!$existingAdhesion) {
                $adhesion = new Adhesions();
                $adhesion->setNom($adhesionData['payer']['firstName'] ?? '');
                $adhesion->setPrenom($adhesionData['payer']['lastName'] ?? '');
                $adhesion->setEmail($adhesionData['payer']['email'] ?? '');
                $adhesion->setTarif($adhesionData['name'] ?? '');
                $adhesion->setMontant($adhesionData['amount'] ?? '');
                $adhesion->setType($adhesionData['type'] ?? '');
                $adhesion->setDate(new \DateTime($adhesionData['order']['date'] ?? 'now'));
                $adhesion->setTelephone(HelloAssoService::telephone($adhesionData));
                $adhesion->setAdresse(HelloAssoService::adresse($adhesionData));

                $adhesionsRepository->save($adhesion, true);
            }
        }

        return $this->render('hello_asso_api/index.html.twig', [
            'donations' => $helloAsso->getDon(),
            'adhesion' => $helloAsso->getAdhesion(),
            'parametres' => $parametres,
            'controller_name' => 'HelloAssoAPIController',
        ]);
    }
}

