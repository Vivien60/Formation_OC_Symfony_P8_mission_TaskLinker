<?php

namespace App\Service;

use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Attribute\Route;

class EmployeService extends AbstractService
{

    public function __construct(private EntityManagerInterface $manager, Security $security)
    {
        parent::__construct($security);
    }

    public function delete(Employe $employe): void
    {
        $this->manager->remove($employe);
        $this->manager->flush();
    }
}
