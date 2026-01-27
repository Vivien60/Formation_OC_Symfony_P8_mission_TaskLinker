<?php

namespace App\Factory;

use App\Core\Factory\SmartPersistentObjectFactory;
use App\Core\Metadata\EntityConstraintReader;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends SmartPersistentObjectFactory<Projet>
 */
final class ProjetFactory extends SmartPersistentObjectFactory
{
    public function __construct(EntityConstraintReader $constraintReader)
    {
        parent::__construct($constraintReader);
    }

    #[\Override]
    public static function class(): string
    {
        return Projet::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'estArchive' => self::faker()->boolean(),
            'nom' => self::faker()->text($this->getFieldMaxLength('nom')),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Projet $projet): void {})
        ;
    }
}
