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
        $parametre = $repository->findOneBy(['nom' => "nom_asso"]);

        return $parametre->getValeur();
    }

    public function setNomAsso($nom_asso)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "nom_asso"]);
        $parametre->setValeur($nom_asso);
        $this->entityManager->flush();
    }

    public function getSigleNomAsso()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "sigle_nom_asso"]);

        return $parametre->getValeur();
    }

    public function setSigleNomAsso($sigle_nom_asso)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "sigle_nom_asso"]);
        $parametre->setValeur($sigle_nom_asso);
        $this->entityManager->flush();
    }

    public function getAssoImg1()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "logo"]);

        return $parametre->getValeur();
    }


    public function getBodyText1()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text1"]);

        return $parametre->getValeur();
    }

    public function setBodyText1($body_text1)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text1"]);
        $parametre->setValeur($body_text1);
        $this->entityManager->flush();
    }

    public function getBodyText2()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text2"]);

        return $parametre->getValeur();
    }

    public function setBodyText2($body_text2)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text2"]);
        $parametre->setValeur($body_text2);
        $this->entityManager->flush();
    }

    public function getBodyText3()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text3"]);

        return $parametre->getValeur();
    }

    public function setBodyText3($body_text3)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text3"]);
        $parametre->setValeur($body_text3);
        $this->entityManager->flush();
    }

    public function getBodyText4()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text4"]);

        return $parametre->getValeur();
    }

    public function setBodyText4($body_text4)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "body_text4"]);
        $parametre->setValeur($body_text4);
        $this->entityManager->flush();
    }

    public function getTemoin1()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1"]);

        return $parametre->getValeur();
    }

    public function setTemoin1($temoin1)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1"]);
        $parametre->setValeur($temoin1);
        $this->entityManager->flush();
    }

    public function getTemoin2()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2"]);

        return $parametre->getValeur();
    }

    public function setTemoin2($temoin2)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2"]);
        $parametre->setValeur($temoin2);
        $this->entityManager->flush();
    }

    public function getTemoin3()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3"]);

        return $parametre->getValeur();
    }

    public function setTemoin3($temoin3)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3"]);
        $parametre->setValeur($temoin3);
        $this->entityManager->flush();
    }

    public function getTemoin4()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4"]);

        return $parametre->getValeur();
    }

    public function setTemoin4($temoin4)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4"]);
        $parametre->setValeur($temoin4);
        $this->entityManager->flush();
    }

    public function getTemoin1Nom()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1_nom"]);

        return $parametre->getValeur();
    }

    public function setTemoin1Nom($temoin1_nom)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1_nom"]);
        $parametre->setValeur($temoin1_nom);
        $this->entityManager->flush();
    }

    public function getTemoin1Prof()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1_prof"]);

        return $parametre->getValeur();
    }

    public function setTemoin1Prof($temoin1_prof)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin1_prof"]);
        $parametre->setValeur($temoin4);
        $this->entityManager->flush();
    }


    public function getTemoin2Nom()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2_nom"]);

        return $parametre->getValeur();
    }

    public function setTemoin2Nom($temoin2_nom)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2_nom"]);
        $parametre->setValeur($temoin2_nom);
        $this->entityManager->flush();
    }

    public function getTemoin2Prof()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2_Prof"]);

        return $parametre->getValeur();
    }

    public function setTemoin2Prof($temoin2_prof)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin2_prof"]);
        $parametre->setValeur($temoin2_prof);
        $this->entityManager->flush();
    }


    public function getTemoin3Nom()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3_nom"]);

        return $parametre->getValeur();
    }

    public function setTemoin3Nom($temoin3_nom)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3_nom"]);
        $parametre->setValeur($temoin3_nom);
        $this->entityManager->flush();
    }

    public function getTemoin3Prof()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3_Prof"]);

        return $parametre->getValeur();
    }

    public function setTemoin3Prof($temoin3_prof)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin3_prof"]);
        $parametre->setValeur($temoin3_prof);
        $this->entityManager->flush();
    }


    public function getTemoin4Nom()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4_nom"]);

        return $parametre->getValeur();
    }

    public function setTemoin4Nom($temoin4_nom)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4_nom"]);
        $parametre->setValeur($temoin4_nom);
        $this->entityManager->flush();
    }

    public function getTemoin4Prof()
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4_Prof"]);

        return $parametre->getValeur();
    }

    public function setTemoin4Prof($temoin4_prof)
    {
        $repository = $this->entityManager->getRepository(Parametre::class);
        $parametre = $repository->findOneBy(['nom' => "temoin4_prof"]);
        $parametre->setValeur($temoin4_prof);
        $this->entityManager->flush();
    }
}
