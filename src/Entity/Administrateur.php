<?php

namespace App\Entity;

use App\Repository\AdministrateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdministrateurRepository::class)]
class Administrateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idAdministrateur = null;

    #[ORM\Column(length: 30)]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAdministrateur(): ?int
    {
        return $this->idAdministrateur;
    }

    public function setIdAdministrateur(int $idAdministrateur): self
    {
        $this->idAdministrateur = $idAdministrateur;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
