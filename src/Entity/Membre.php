<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idMembre = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 30)]
    private ?string $telephone = null;

    #[ORM\Column(length: 30)]
    private ?string $villeOrigine = null;

    #[ORM\Column(length: 30)]
    private ?string $villeActuelle = null;

    #[ORM\Column(length: 30)]
    private ?string $paysResidence = null;

    #[ORM\Column(length: 50)]
    private ?string $profession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdhesion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?int
    {
        return $this->idMembre;
    }

    public function setIdMembre(int $idMembre): self
    {
        $this->idMembre = $idMembre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVilleOrigine(): ?string
    {
        return $this->villeOrigine;
    }

    public function setVilleOrigine(string $villeOrigine): self
    {
        $this->villeOrigine = $villeOrigine;

        return $this;
    }

    public function getVilleActuelle(): ?string
    {
        return $this->villeActuelle;
    }

    public function setVilleActuelle(string $villeActuelle): self
    {
        $this->villeActuelle = $villeActuelle;

        return $this;
    }

    public function getPaysResidence(): ?string
    {
        return $this->paysResidence;
    }

    public function setPaysResidence(string $paysResidence): self
    {
        $this->paysResidence = $paysResidence;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDateAdhesion(): ?\DateTimeInterface
    {
        return $this->dateAdhesion;
    }

    public function setDateAdhesion(\DateTimeInterface $dateAdhesion): self
    {
        $this->dateAdhesion = $dateAdhesion;

        return $this;
    }
}
