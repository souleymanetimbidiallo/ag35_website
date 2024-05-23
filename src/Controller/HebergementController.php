<?php

namespace App\Controller;
use App\Repository\MesImageRepository;
use App\Service\MenuService;
use App\Service\ParameterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hebergement;
use App\Form\HebergementType;
use App\Repository\ServiceRepository;
use App\Service\TexteService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Psr\Log\LoggerInterface;
class HebergementController extends AbstractController
{
   // #[Route('/hebergement', name: 'app_hebergement')]
   private $logger;
  
    public function index(
        Request $request, 
        ParameterService $parameterService, 
        EntityManagerInterface $manager, 
        ServiceRepository $serviceRepository,
        MenuService $menuService,
        MesImageRepository $mesImageRepository,
        TexteService $texteService,
        SluggerInterface $slugger, 
        ?string $filesDirectory, // the problem is here
         FileUploader $fileUploader,
         LoggerInterface $logger
       
    ): Response
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
        

       
            $hebergement = new Hebergement();
            $form = $this->createForm(HebergementType::class, $hebergement);      

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $hebergement = $form->getData();
               

             // Maintenant que l'enregistrement est fait, obtenir le chemin correct pour le répertoire de destination
            $filesDirectory = $parameterService->getParametreByName('%kernel.project_dir%/public/uploads/fichiers');

                /** @var UploadedFile $brochureFile */
                $brochureFile = $form->get('passeport')->getData();
                $attestationFile = $form->get('attestation')->getData(); 

                if ($brochureFile) {
                    $newBrochureFileName = $fileUploader->upload($brochureFile);
                    $hebergement->setPasseport($newBrochureFileName);
                    try {
                        $brochureFile->move($filesDirectory, $newBrochureFileName);
                    }catch (FileException $e) {
                        // Afficher un message d'erreur personnalisé
                    }
                    
                }
            
                if ($attestationFile) {
                    $newAttestationFileName = $fileUploader->upload($attestationFile);
                    $hebergement->setAttestation($newAttestationFileName);
                    try {
                        $attestationFile->move($filesDirectory, $newAttestationFileName);
                    } catch (FileException $e) {
                        // Afficher un message d'erreur personnalisé
                      
                    }

                }
                $entityManager = $this->getDoctrine()->getManager();
                 // Enregistrer les données dans la base de données
                 $manager->persist($hebergement);
                 $manager->flush();  
            
                // Redirection vers une autre page
                return $this->redirectToRoute('hebergement');
            }
            $hebergement->setPasseport(
                $filesDirectory !== null ? new File($filesDirectory.DIRECTORY_SEPARATOR.$hebergement->getPasseport()) :null
               
            );
            

            $hebergement->setAttestation(
                $filesDirectory !== null ? new File($filesDirectory.DIRECTORY_SEPARATOR.$hebergement->getAttestation()) : null
            );
            return $this->render('hebergement/heberg.html.twig', [
                'form' => $form->createView(),
                'controller_name' => 'HebergementController',
                'parametres' => $parametres,
            ]);
        }  
    }
