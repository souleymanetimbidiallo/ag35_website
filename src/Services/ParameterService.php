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

    public function getAssoImg1()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "logo"]);

        return $parametre->getValeur();
    }
}
