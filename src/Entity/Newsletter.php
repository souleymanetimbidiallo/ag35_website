<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idNewsletter = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdNewsletter(): ?int
    {
        return $this->idNewsletter;
    }

    public function setIdNewsletter(int $idNewsletter): self
    {
        $this->idNewsletter = $idNewsletter;

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
}
