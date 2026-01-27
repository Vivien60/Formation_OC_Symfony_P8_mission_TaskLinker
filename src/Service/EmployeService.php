<?php

namespace App\Service;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

class EmployeService
{

    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function delete(Employe $employe): void
    {
        $this->manager->remove($employe);
        $this->manager->flush();
    }
}
