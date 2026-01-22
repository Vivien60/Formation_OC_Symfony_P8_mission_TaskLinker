<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ProjetRepository $repo): Response
    {
        $projets = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'projets' => $projets,
        ]);
    }
}
