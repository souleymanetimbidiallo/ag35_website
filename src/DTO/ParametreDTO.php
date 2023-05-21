<?php
// src/DTO/ParametreDTO.php

namespace App\DTO;

class ParametreDTO
{
    private $parametres;

    public function getParametres(): ?array
    {
        return $this->parametres;
    }

    public function setParametres(array $parametres): self
    {
        $this->parametres = $parametres;

        return $this;
    }
}
