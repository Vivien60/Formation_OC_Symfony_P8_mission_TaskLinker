<?php

namespace App\Service;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

class EmployeService
{

    public function __construct()
    {
    }

    public function delete(Employe $employe, EntityManagerInterface $manager): void
    {
        $taches = $employe->getTaches();
        $taches->map(function ($tache) use ($manager) {
            $tache->removeEmploye();
            $manager->persist($tache);
        });
        $manager->flush();
        $manager->remove($employe);
        $manager->flush();
    }
}