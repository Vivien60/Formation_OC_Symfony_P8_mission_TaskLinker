<?php

namespace App\Core\Factory;

use App\Core\Metadata\EntityConstraintReader;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
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
