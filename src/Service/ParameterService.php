<?php

namespace App\Service;

use App\Entity\Parametre;
use Doctrine\ORM\EntityManagerInterface;

class ParameterService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getParametreByName(string $nom)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => $nom]);
        if ($parametre == null) {
            return "";
        }

        return $parametre->getValeur();
    }

    public function getSiteName()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_name"]);

        return $parametre->getValeur();
    }

    public function setSiteName($siteName)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_name"]);
        $parametre->setValeur($siteName);
        $this->entityManager->flush();
    }



    public function getSiteAdresse()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_adresse"]);

        return $parametre->getValeur();
    }

    public function setSiteAdresse($siteAdresse)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_adresse"]);
        $parametre->setValeur($siteAdresse);
        $this->entityManager->flush();
    }


    public function getSiteEmail()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_email"]);

        return $parametre->getValeur();
    }

    public function setSiteEmail($siteEmail)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_email"]);
        $parametre->setValeur($siteEmail);
        $this->entityManager->flush();
    }



    public function getSiteTelephone()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_telephone"]);

        return $parametre->getValeur();
    }

    public function setSiteTelephone($siteTelephone)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "site_telephone"]);
        $parametre->setValeur($siteTelephone);
        $this->entityManager->flush();
    }


    public function getLienPageFb()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_page_fb"]);

        return $parametre->getValeur();
    }

    public function setSiteLienPageFb($LienPageFb)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_page_fb"]);
        $parametre->setValeur($LienPageFb);
        $this->entityManager->flush();
    }


    public function getLienGroupeFb()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_groupe_fb"]);

        return $parametre->getValeur();
    }

    public function setLienGroupeFb($lienGroupeFb)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_groupe_fb"]);
        $parametre->setValeur($lienGroupeFb);
        $this->entityManager->flush();
    }


    public function getLienWhatsApp()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_whatsApp"]);

        return $parametre->getValeur();
    }

    public function setLienWhatsApp($lienWhatsApp)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "lien_whatsApp"]);
        $parametre->setValeur($lienWhatsApp);
        $this->entityManager->flush();
    }

    public function getNomAsso()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "nom_association"]);

        return $parametre->getValeur();
    }

    public function setNomAsso($nom_asso)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "nom_association"]);
        $parametre->setValeur($nom_asso);
        $this->entityManager->flush();
    }

    public function getTitre_accueil_video()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_video"]);

        return $parametre->getValeur();
    }

    public function setTitre_accueil_video($titre_accueil_video)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_video"]);
        $parametre->setValeur($titre_accueil_video);
        $this->entityManager->flush();
    }

    public function getTitre_accueil_event()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_event"]);

        return $parametre->getValeur();
    }

    public function setTitre_accueil_event($titre_accueil_event)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_event"]);
        $parametre->setValeur($titre_accueil_event);
        $this->entityManager->flush();
    }

    public function getTitre_accueil_temoin()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_temoin"]);

        return $parametre->getValeur();
    }

    public function setTitre_accueil_temoin($titre_accueil_temoin)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "titre_accueil_temoin"]);
        $parametre->setValeur($titre_accueil_temoin);
        $this->entityManager->flush();
    }
}
