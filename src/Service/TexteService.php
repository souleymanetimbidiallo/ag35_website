<?php

namespace App\Service;

use App\Entity\TexteParam;
use Doctrine\ORM\EntityManagerInterface;

class TexteService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getParametreByName(string $titre)
    {
        $repository = $this->entityManager->getRepository(TexteParam::class);
        $texte = $repository->findOneBy(['titre' => $titre]);
        if ($texte == null) {
            return "";
        }

        return $texte->getDescription();
    }
}
