<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MenuRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(MenuRepository $menuRepository)
    {
        return $this->render('accueil/index.html.twig', [
            'menus' => $menuRepository->findAll()
        ]);
    }
}
