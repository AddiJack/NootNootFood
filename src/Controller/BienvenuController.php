<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BienvenuController extends AbstractController
{
    /**
     * @Route("/bienvenu", name="bienvenu")
     */
    public function index()
    {
        return $this->render('bienvenu/index.html.twig', [
            'controller_name' => 'BienvenuController',
        ]);
    }
}
