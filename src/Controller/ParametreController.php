<?php

namespace App\Controller;

use App\Service\ParameterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParametreController extends AbstractController
{
    /**
     * @Route("/parametre/update", name="parametre_update")
     */
    public function update(EntityManagerInterface $entityManager): Response
    {

        $repository = $entityManager->getRepository(Parametre::class);

        $parametre = $repository->findOneBy(['nom' => "logo"]);



        $form = $this->createForm(ParametreType::class, $parametre, [
            'image_directory' => $this->getParameter('img_params'),
        ]);

        return $this->render('params_form.html.twig', [
            'form' => $form
        ]);
    }
}
