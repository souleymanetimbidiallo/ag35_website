<?php

namespace App\Entity;

use App\Repository\ParamImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParamImageRepository::class)]
class ParamImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    public function getId(): ?int
    {
        return $this->id;
    }
}
