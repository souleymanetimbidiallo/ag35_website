<?php

namespace App\Controller;

use App\Service\MenuService;
use App\Service\ParameterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Pages de contenu : FAQ, mentions légales, confidentialité.
 */
class PagesController extends AbstractController
{
    public function __construct(
        private ParameterService $parameterService,
        private MenuService $menuService,
    ) {
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->page('pages/faq.html.twig', 'faq');
    }

    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->page('pages/mentions_legales.html.twig', 'mentions');
    }

    #[Route('/confidentialite', name: 'app_confidentialite')]
    public function confidentialite(): Response
    {
        return $this->page('pages/confidentialite.html.twig', 'confidentialite');
    }

    private function page(string $template, string $menu): Response
    {
        $p = $this->parameterService;
        $m = $this->menuService;

        return $this->render($template, [
            'current_menu' => $menu,
            'parametres' => [
                'site_name' => $p->getSiteName(),
                'nom_association' => $p->getParametreByName('nom_association'),
                'address' => $p->getSiteAdresse(),
                'email' => $p->getSiteEmail(),
                'telephone' => $p->getSiteTelephone(),
                'lien_page_fb' => $p->getLienPageFb(),
                'lien_groupe_fb' => $p->getLienGroupeFb(),
                'lien_whatsApp' => $p->getLienWhatsApp(),
                'lien_donation' => $p->getParametreByName('lien_donation'),
                'menu_accueil' => $m->getAccueil(),
                'menu_apropos' => $m->getApropos(),
                'menu_activite' => $m->getActivite(),
                'menu_donation' => $m->getDonation(),
                'menu_adhesion' => $m->getAdhesion(),
                'menu_hebergement' => $m->getHebergement(),
                'menu_contact' => $m->getContact(),
                'menu_evenement' => $m->getEvenement(),
                'menu_actualite' => $m->getActualite(),
                'menu_guide' => $m->getGuide(),
                'menu_volontariat' => $m->getVolontariat(),
            ],
        ]);
    }
}
