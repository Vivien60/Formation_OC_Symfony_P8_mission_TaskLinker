<?php

namespace App\Service;

use App\Entity\Employe;
use App\Repository\EmployeRepository;
use App\Repository\ProjetRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class ProjetService extends AbstractService
{
    public function __construct(private ProjetRepository $projetRepository, Security $security)
    {
        parent::__construct($security);
    }

    public function getProjets()
    {
        if( !$this->security->isGranted('ROLE_ADMIN') ) {
            return $this->projetRepository->findActifsByEmploye($this->security->getUser());
        }
        return $this->projetRepository->findProjetsActifs();
    }
}