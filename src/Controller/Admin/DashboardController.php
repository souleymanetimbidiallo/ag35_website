<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use App\Entity\Adhesions;
use App\Entity\Admin;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Entity\Guide;
use App\Entity\Media;
use App\Entity\Membre;
use App\Entity\MesImage;
use App\Entity\ParamImage;
use App\Entity\Service;
use App\Entity\Temoin;
use App\Entity\TexteParam;
use App\Entity\Valeur;
use App\Entity\Categoriesujet;
use App\Entity\Hebergement;
use App\Entity\Volontariat;
use App\Entity\Volontaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\HelloAssoService; // Ajoute le service HelloAssoService

class DashboardController extends AbstractDashboardController
{
    private $helloAssoService;

    public function __construct(HelloAssoService $helloAssoService)
    {
        $this->helloAssoService = $helloAssoService;
    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $this->helloAssoService->syncAdhesions();
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            //->setTitle('Administration du site AG35');
            ->setTitle('<img src="img/logo_ag35.png"> Espace Admin de <span class="text-small">AG35</span>')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Membres', 'fas fa-users', Membre::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-message', Contact::class);
        yield MenuItem::linkToCrud('Actualites', 'fas fa-rss', Actualite::class);
        yield MenuItem::linkToCrud('Evenements', 'fas fa-calendar', Evenement::class);
        yield MenuItem::linkToCrud('Galerie', 'fas fa-eject', Media::class);
        yield MenuItem::linkToCrud('Service', 'fas fa-servicestack', Service::class);
        yield MenuItem::linkToCrud('Temoin', 'fas fa-comments', Temoin::class);
        yield MenuItem::linkToCrud('Valeur-Asso', 'fas fa-bullseye', Valeur::class);
        yield MenuItem::linkToCrud('Partenaires-Sponsors', 'fas fa-handshake', ParamImage::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', MesImage::class);
        yield MenuItem::linkToCrud('Textes', 'fas fa-message', TexteParam::class);
        yield MenuItem::linkToCrud('Guide-PDF', 'fas fa-file', Guide::class);
        yield MenuItem::linkToCrud('Admin', 'fas fa-lock', Admin::class);
        yield MenuItem::linkToCrud('Categoriesujet', 'fas fa-list', Categoriesujet::class);
        yield MenuItem::linkToRoute('Envoyer Newsletter', 'fas fa-envelope', 'envoyer_newsletter');
        yield MenuItem::linkToCrud('Hébergement ', 'fas fa-lock', Hebergement::class);
        yield MenuItem::linkToCrud('Volontariat ', 'fas fa-lock', Volontariat::class);
        yield MenuItem::linkToCrud('Volontaire ', 'fas fa-lock', Volontaire::class);
        yield MenuItem::linkToCrud('Adhésions ', 'fas fa-lock', Adhesions::class);
        yield MenuItem::linkToRoute('Calendrier', 'fas fa-lock', 'cal');
        yield MenuItem::linkToRoute('Donations', 'fas fa-lock', 'api');
        
    }
}
