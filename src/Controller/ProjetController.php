<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Statut;
use App\Entity\Tache;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use App\Repository\StatutRepository;
use App\Service\ProjetService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projet')]
final class ProjetController extends AbstractController
{
    #[Route('', name: 'app_projet')]
    public function index(ProjetService $service): Response
    {
        $projets = $service->getProjets();
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

    #[Route('/{id}/edit', name: 'app_projet_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Projet $projet, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($projet);
            $manager->flush();
            return $this->redirectToRoute('app_projet_show', ['id' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }


    #[Route('/new', name: 'app_projet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($projet);
            $manager->flush();
            return $this->redirectToRoute('app_projet_show', ['id' => $projet->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form,
        ]);
    }
}
