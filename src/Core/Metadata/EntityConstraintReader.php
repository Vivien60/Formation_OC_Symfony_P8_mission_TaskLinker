<?php

namespace App\Core\Metadata;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\FieldMapping;
use Doctrine\ORM\Mapping\MappingException;

/**
 * Permet de lire certaines contraintes des champs des entités métier
 */
class EntityConstraintReader
{
    const string CONSTRAINT_LENGTH = 'length';

    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    public function getFieldMaxLength(string $class, string $field)
    {
        return $this->getConstraint($this->getFieldMapping($class, $field), self::CONSTRAINT_LENGTH);
    }

    private function getConstraint(FieldMapping $fieldMapping, string $constraintName) : mixed
    {
        return $fieldMapping[$constraintName] ?? null;
    }

    private function getFieldMapping(string $class, string $field): FieldMapping
    {
        return $this->manager->getClassMetadata($class)->getFieldMapping($field);
    }
}