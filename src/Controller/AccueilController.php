<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MenuRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(PlatsRepository $platsRepository)
    {
        return $this->render('accueil/index.html.twig', [
            'plats' => $platsRepository->findAll()
        ]);
    }
}
