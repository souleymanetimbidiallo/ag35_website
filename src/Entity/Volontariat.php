<?php

namespace App\Entity;

use App\Repository\VolontariatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolontariatRepository::class)]
class Volontariat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\OneToMany(mappedBy: 'volontariat', targetEntity: Volontaire::class, orphanRemoval: true)]
    private Collection $volontaire;

    public function __construct()
    {
        $this->volontaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * @return Collection<int, Volontaire>
     */
    public function getVolontaire(): Collection
    {
        return $this->volontaire;
    }

    public function addVolontaire(Volontaire $volontaire): static
    {
        if (!$this->volontaire->contains($volontaire)) {
            $this->volontaire->add($volontaire);
            $volontaire->setVolontariat($this);
        }

        return $this;
    }

    public function removeVolontaire(Volontaire $volontaire): static
    {
        if ($this->volontaire->removeElement($volontaire)) {
            // set the owning side to null (unless already changed)
            if ($volontaire->getVolontariat() === $this) {
                $volontaire->setVolontariat(null);
            }
        }

        return $this;
    }
}
