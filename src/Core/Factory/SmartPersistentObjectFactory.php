<?php

namespace App\Core\Factory;

use App\Core\Metadata\EntityConstraintReader;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * Permets d'associer un constraint reader à une factory de fixture, en étendant celle-ci
 * Wrappe les méthodes du constraint reader.
 * Pour l'utiliser, il suffit de ffaire étendre les factory de cette classe
 * @template T of object
 * @extends PersistentObjectFactory<T>
 */
abstract class SmartPersistentObjectFactory extends PersistentObjectFactory
{
    public function __construct(private EntityConstraintReader $constraintReader)
    {
        parent::__construct();
    }

    protected function getFieldMaxLength(string $field): ?int
    {
        return $this->constraintReader->getFieldMaxLength(static::class(), $field);
    }
}
