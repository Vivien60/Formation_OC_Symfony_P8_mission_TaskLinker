<?php

namespace App\Service;

use App\Repository\ProjetRepository;

class ProjetService
{
    public function __construct(private ProjetRepository $projetRepository)
    {

    }

    public function getProjets()
    {
        return $this->projetRepository->findProjetsActifs();
    }
}