<?php

namespace App\DataFixtures;

use App\Factory\EmployeFactory;
use App\Factory\ProjetFactory;
use App\Factory\StatutFactory;
use App\Factory\TacheFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use phpDocumentor\Reflection\ProjectFactory;

use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statuts = [ 'To Do', 'Doing', 'Done', ];
        foreach ($statuts as $statut) {
            StatutFactory::createOne(['libelle' => $statut]);
        }
        EmployeFactory::createMany(35);
        $projets = ProjetFactory::createMany(10, function() {
            // 3-6 employés par projet
            return [
                'employe' => EmployeFactory::randomRange(3, 6),
            ];
        });
        /**
         * @var \App\Entity\Projet $projet
         */
        array_map(fn($projet) => TacheFactory::createMany(rand(3, 8), [
            'employe' => faker()->randomElement($projet->getEmploye()->toArray()),
            'projet' => $projet,
        ]), $projets);

        ProjetFactory::createOne(['nom' => 'TaskLinker', 'estArchive' => false]);
        ProjetFactory::createOne(['nom' => 'Site vitrine Les Soeurs Marchand', 'estArchive' => false]);
    }
}
