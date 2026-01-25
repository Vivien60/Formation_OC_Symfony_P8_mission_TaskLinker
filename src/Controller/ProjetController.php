<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Statut;
use App\Entity\Tache;
use App\Repository\ProjetRepository;
use App\Repository\StatutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projet')]
final class ProjetController extends AbstractController
{
    #[Route('', name: 'app_projet')]
    public function index(ProjetRepository $repo): Response
    {
        $projets = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'projets' => $projets,
        ]);
    }

    #[Route('/{id}', name: 'app_projet_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Projet $projet, StatutRepository $repo): Response
    {
        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
            'tachesParStatut' => $projet->getTachesGroupeesParStatut(),
            'statuts' => $repo->findAll(),
        ]);
    }
}
