<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employe')]
final class EmployeController extends AbstractController
{
    #[Route('/index', name: 'app_employe_index')]
    public function index(EmployeRepository $repo): Response
    {
        $employes = $repo->findAll();
        return $this->render('employe/index.html.twig', [
            'employes' => $employes
        ]);
    }

    #[Route('/{id}', name: 'app_employe_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Employe $employe, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employe);
            $manager->flush();
            return $this->redirectToRoute('app_employe_index');
        }
        return $this->render('employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form,
        ]);
    }
}
