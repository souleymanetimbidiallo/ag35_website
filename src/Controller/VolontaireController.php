<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ServiceRepository;
use App\Form\VolontaireType;
use App\Entity\Volontaire;
use App\Entity\Volontariat;
use App\Service\MenuService;
use App\Service\ParameterService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MesImageRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Service\TexteService;

class VolontaireController extends AbstractController
{
   // #[Route('/volontaire', name: 'app_volontaire')]
   public function index(
    Request $request, 
    ParameterService $parameterService, 
    EntityManagerInterface $manager, 
    ServiceRepository $serviceRepository,
    ManagerRegistry $doctrine,
    MenuService $menuService,
    MesImageRepository $mesImageRepository,
    TexteService $texteService,
    $volontariatId=null
   
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
    

    $volontaire = new Volontaire();
    $form = $this->createForm(VolontaireType::class,null, [
        'volontariat_id' => $volontariatId,
    ]);  
   
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
       // Récupérer les données soumises du formulaire
      
       $data = $form->getData();
       //utiliser les setters après soumission du formulaire 
       $volontaire->setNom($data->getNom());
       $volontaire->setPrenom($data->getPrenom());
       $volontaire->setEmail($data->getEmail());
       $volontaire->setTelephone($data->getTelephone());
       $volontaire->setMotivation($data->getMotivation());
       

       // Récupérer l'entité Volontariat en fonction de l'ID passé dans l'URL
       $volontariatId = $request->query->get('id');
       $volontariat = $manager->getRepository(Volontariat::class)->find($volontariatId);
       
       // Associer le volontariat au volontaire
       $volontaire->setVolontariat($volontariat);

       // Persistez le volontaire en base de données
         $entityManager = $this->getDoctrine()->getManager();
        $entityManager = $doctrine->getManager();
       $entityManager->persist($volontaire);
       $entityManager->flush();

       // Ajouter un message flash de succès
       $this->addFlash('success', 'Votre demande de volontariat a été enregistrée avec succès !');

       // Rediriger l'utilisateur vers une autre page
       return $this->redirectToRoute('volontaire');
    }
    return $this->render('volontaire/volontaire.html.twig', [
        'form' => $form->createView(),
        'controller_name' => 'VolontaireController',
        'parametres'   => $parametres,
        
        
    ]);
}
}