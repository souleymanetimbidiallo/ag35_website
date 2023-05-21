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


        $parametres = [
            'site_name' => $parameterService->getSiteName(),
            'address' => $parameterService->getSiteAdresse(),
            'email' => $parameterService->getSiteEmail(),
            'telephone' => $parameterService->getSiteTelephone(),
            'lien_page_fb' => $parameterService->getLienPageFb(),
            'lien_groupe_fb' => $parameterService->getLienGroupeFb(),
            'lien_whatsApp' => $parameterService->getLienWhatsApp(),
            'asso_img1' => $parameterService->getAssoImg1(),
            //'asso_img2' => $parameterService->getAssoImg2(),
            //'asso_img3' => $parameterService->getAssoImg3()
        ];


        return $this->render('index.html.twig', [
            'current_menu' => 'accueil',
            'parametres' => $parametres

        ]);
    }


    /**
     * @Route("/upload-image", name="upload_image")
     */
    public function uploadImage(Request $request, SluggerInterface $slugger)
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get('fichier')->getData();

            // Génération d'un nom de fichier unique
            $nomFichier = md5(uniqid()) . '.' . $fichier->guessExtension();

            // Déplace le fichier vers le répertoire où vous souhaitez le stocker
            $fichier->move(
                $this->getParameter('dossier_images'), // Chemin vers le dossier de stockage des images
                $nomFichier
            );

            // Met à jour le nom de l'image dans l'entité
            $image->setNom($nomFichier);

            // Enregistre l'image dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            // Redirection vers une autre page ou effectuez une autre action
            return $this->redirectToRoute('accueil');
        }

        return $this->render('image/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
