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
