<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HebergementRepository::class)]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $universite = null;

    #[ORM\Column(type: Types::BLOB)]
    private $passeport = null;

    #[ORM\Column(type: Types::BLOB)]
    private $attestation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUniversite(): ?string
    {
        return $this->universite;
    }

    public function setUniversite(string $universite): static
    {
        $this->universite = $universite;

        return $this;
    }

    public function getPasseport()
    {
        return $this->passeport;
    }

    public function setPasseport($passeport): static
    {
        $this->passeport = $passeport;

        return $this;
    }

    public function getAttestation()
    {
        return $this->attestation;
    }

    public function setAttestation($attestation): static
    {
        $this->attestation = $attestation;

        return $this;
    }
}
