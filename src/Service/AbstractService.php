<?php

namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;

abstract class AbstractService
{
    public function __construct(
        protected Security $security
    ) {
    }
}