<?php

namespace App\Controller;

use App\Entity\Projet;
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

    #[Route('/{id}', name: 'app_tache_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Tache $tache, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($tache);
            $manager->flush();

            return $this->redirectToRoute('app_tache_show', ['id' => $tache->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/projet/{idProjet}/tache/new', name: 'app_tache_new', requirements: ['idProjet' => '\d+'], methods: ['GET', 'POST'])]
    public function add(Request $request, ?Tache $tache, int $idProjet, EntityManagerInterface $manager): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setProjet($manager->getReference(Projet::class, $idProjet));
            $manager->persist($tache);
            $manager->flush();

            return $this->redirectToRoute('app_projet_show', ['id' => $idProjet], Response::HTTP_SEE_OTHER);
        }
        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }
}
