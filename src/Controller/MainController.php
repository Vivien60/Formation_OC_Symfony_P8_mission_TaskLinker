<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Repository\ProjetRepository;
use App\Service\ProjetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ProjetService $service): Response
    {
        $projets = $service->getProjets();
        return $this->render('main/index.html.twig', [
            'projets' => $projets,
        ]);
    }
}
