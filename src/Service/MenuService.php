<?php

namespace App\Service;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;

class MenuService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function getAccueil()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "accueil"]);

        return $menu->getLien();
    }

    public function setAccueil($accueil)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "accueil"]);
        $menu->setLien($accueil);
        $this->entityManager->flush();
    }

    public function getApropos()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "apropos"]);

        return $menu->getLien();
    }

    public function setApropos($apropos)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "apropos"]);
        $menu->setLien($apropos);
        $this->entityManager->flush();
    }


    public function getActivite()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "activite"]);

        return $menu->getLien();
    }

    public function setActivite($activite)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "activite"]);
        $menu->setLien($activite);
        $this->entityManager->flush();
    }


    public function getMultimedia()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "multimedia"]);

        return $menu->getLien();
    }

    public function setMultimedia($multimedia)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "multimedia"]);
        $menu->setLien($multimedia);
        $this->entityManager->flush();
    }


    public function getDonation()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "donation"]);

        return $menu->getLien();
    }

    public function setDonation($donation)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "donation"]);
        $menu->setLien($donation);
        $this->entityManager->flush();
    }

    public function getAdhesion()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "adhesion"]);

        return $menu->getLien();
    }

    public function setAdhesion($adhesion)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "adhesion"]);
        $menu->setLien($adhesion);
        $this->entityManager->flush();
    }

    public function getContact()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "contact"]);

        return $menu->getLien();
    }

    public function setContact($contact)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "contact"]);
        $menu->setLien($contact);
        $this->entityManager->flush();
    }

    public function getEvenement()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "evenement"]);

        return $menu->getLien();
    }

    public function setEvenement($evenement)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "evenement"]);
        $menu->setLien($evenement);
        $this->entityManager->flush();
    }

    public function getActualite()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "actualite"]);

        return $menu->getLien();
    }

    public function setActualite($actualite)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "actualite"]);
        $menu->setLien($actualite);
        $this->entityManager->flush();
    }
    public function getVolontariat()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "volontariat"]);

        return $menu->getLien();
    }

    public function setVolontariat($volontariat)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "volontariat"]);
        $menu->setLien($volontariat);
        $this->entityManager->flush();
    }

    public function getGuide()
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "guide"]);

        return $menu->getLien();
    }

    public function setGuide($guide)
    {
        $repository = $this->entityManager->getRepository(Menu::class);
        $menu = $repository->findOneBy(['nom' => "guide"]);
        $menu->setLien($guide);
        $this->entityManager->flush();
    }
}
