<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Statut;
use App\Entity\Tache;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tache')]
final class TacheController extends AbstractController
{
    #[Route('', name: 'app_tache')]
    public function index(): Response
    {
        return $this->render('tache/index.html.twig', [
            'controller_name' => 'TacheController',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tache);
            $manager->flush();

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/projet/{idProjet}/tache/new', name: 'app_tache_new', requirements: ['idProjet' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/projet/{idProjet}/tache/new/{idStatut}', name: 'app_tache_new_with_status',
        requirements: ['idProjet' => '\d+', 'idStatut' => '\d+'], methods: ['GET', 'POST'])
    ]
    public function add(Request $request, ?Tache $tache, int $idProjet, int $idStatut, EntityManagerInterface $manager): Response
    {
        $tache = new Tache();
        $tache->setStatut($manager->getReference(Statut::class, $idStatut));
        $tache->setProjet($manager->getReference(Projet::class, $idProjet));
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tache);
            $manager->flush();

            return $this->redirectToRoute('app_projet_show', ['id' => $idProjet], Response::HTTP_SEE_OTHER);
        }
        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_tache_delete', requirements:['id' => '\d+'], methods: ['POST'])]
    public function delete(Tache $tache, EntityManagerInterface $manager): Response
    {
        $idProjet = $tache->getProjet()->getId();
        $manager->remove($tache);
        $manager->flush();
        return $this->redirectToRoute('app_projet_show', ['id' => $idProjet], Response::HTTP_SEE_OTHER);
    }
}
