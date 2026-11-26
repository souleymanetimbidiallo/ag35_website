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
use App\Repository\AdhesionsRepository;
use App\Repository\ContactRepository;
use App\Repository\EvenementRepository;
use App\Repository\HebergementRepository;
use App\Repository\NewsletterRepository;
use App\Repository\VolontaireRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\HelloAssoService;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private HelloAssoService $helloAssoService,
        private ContactRepository $contactRepository,
        private EvenementRepository $evenementRepository,
        private AdhesionsRepository $adhesionsRepository,
        private VolontaireRepository $volontaireRepository,
        private HebergementRepository $hebergementRepository,
        private NewsletterRepository $newsletterRepository,
        private LoggerInterface $logger,
    ) {
    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        // Synchronisation HelloAsso : une panne de l'API ne doit pas bloquer l'admin.
        try {
            $this->helloAssoService->syncAdhesions();
        } catch (\Throwable $e) {
            $this->logger->error('Synchronisation HelloAsso impossible', ['exception' => $e]);
            $this->addFlash('warning', 'Les adhésions HelloAsso n\'ont pas pu être synchronisées. Réessayez plus tard.');
        }

        $evenementsAVenir = $this->evenementRepository->createQueryBuilder('e')
            ->where('e.dateFin >= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('e.dateDebut', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'stats' => [
                'contacts' => $this->contactRepository->count([]),
                'adhesions' => $this->adhesionsRepository->count([]),
                'volontaires' => $this->volontaireRepository->count([]),
                'hebergements' => $this->hebergementRepository->count([]),
                'abonnes' => $this->newsletterRepository->count([]),
                'evenements' => count($evenementsAVenir),
            ],
            'derniers_contacts' => $this->contactRepository->findBy([], ['id' => 'DESC'], 5),
            'evenements_a_venir' => $evenementsAVenir,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/img/logo_ag35.png" alt=""> <span>AG35<small>Administration</small></span>')
            ->setFaviconPath('/img/logo_ag35.png')
            ->renderContentMaximized();
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addHtmlContentToHead('<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">')
            ->addCssFile('css/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToUrl('Voir le site', 'fas fa-external-link-alt', '/')->setLinkTarget('_blank');

        yield MenuItem::section('Communauté');
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope-open-text', Contact::class);
        yield MenuItem::linkToCrud('Adhésions', 'fas fa-id-card', Adhesions::class);
        yield MenuItem::linkToCrud('Volontaires', 'fas fa-hands-helping', Volontaire::class);
        yield MenuItem::linkToCrud('Volontariat', 'fas fa-clipboard-list', Volontariat::class);
        yield MenuItem::linkToCrud('Hébergement', 'fas fa-bed', Hebergement::class);
        yield MenuItem::linkToCrud('Membres', 'fas fa-users', Membre::class);

        yield MenuItem::section('Contenu du site');
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', Actualite::class);
        yield MenuItem::linkToCrud('Événements', 'fas fa-calendar-alt', Evenement::class);
        yield MenuItem::linkToCrud('Galerie', 'fas fa-photo-video', Media::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class);
        yield MenuItem::linkToCrud('Témoignages', 'fas fa-comments', Temoin::class);
        yield MenuItem::linkToCrud('Valeurs', 'fas fa-bullseye', Valeur::class);
        yield MenuItem::linkToCrud('Partenaires & sponsors', 'fas fa-handshake', ParamImage::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', MesImage::class);
        yield MenuItem::linkToCrud('Textes', 'fas fa-font', TexteParam::class);
        yield MenuItem::linkToCrud('Guide PDF', 'fas fa-file-pdf', Guide::class);

        yield MenuItem::section('Communication');
        yield MenuItem::linkToRoute('Envoyer la newsletter', 'fas fa-paper-plane', 'envoyer_newsletter');
        yield MenuItem::linkToCrud('Catégories de sujets', 'fas fa-tags', Categoriesujet::class);
        yield MenuItem::linkToRoute('Calendrier', 'fas fa-calendar', 'cal');
        yield MenuItem::linkToRoute('Donations', 'fas fa-hand-holding-heart', 'api');

        yield MenuItem::section('Paramètres');
        yield MenuItem::linkToCrud('Comptes admin', 'fas fa-user-shield', Admin::class);
    }
}
