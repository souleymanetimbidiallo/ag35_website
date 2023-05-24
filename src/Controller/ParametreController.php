<?php
// src/Controller/ParametreController.php

namespace App\Controller;

use App\DTO\ParametreDTO;
use App\Entity\Parametre;
use App\Service\ParameterService;
use App\Form\ParametreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParametreController extends AbstractController
{
    /**
     * @Route("/parametre/edit", name="parametre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ParameterService $parameterService, EntityManagerInterface $entityManager): Response
    {

        $parametres = [
            'site_name' => $parameterService->getParametreByName("site_name"),
            'address' => $parameterService->getParametreByName("site_adresse"),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
            'asso_img1' => $parameterService->getAssoImg1(),
            'asso_img2' => $parameterService->getAssoImg2(),
            'asso_img3' => $parameterService->getAssoImg3(),
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


        $parametreDTO = new ParametreDTO();
        $parametreDTO->setParametres($this->getDoctrine()->getRepository(Parametre::class)->findAll());


        $form = $this->createForm(ParametreType::class, $parametreDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les paramètres modifiés
            $parametresModifies = $parametreDTO->getParametres();

            // Mettre à jour les paramètres dans la base de données
            foreach ($parametresModifies as $parametreModifie) {
                // Effectuer les opérations de mise à jour nécessaires pour chaque paramètre
                //dd($parametreModifie);
                $entityManager->persist($parametreModifie);
                $entityManager->flush();
            }

            return $this->redirectToRoute('parametre_edit');
        }

        return $this->render('parametres/edit.html.twig', [
            'form' => $form->createView(),
            'parametres' => $parametres
        ]);
    }

    // ...
}
