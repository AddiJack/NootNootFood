<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu", methods={"GET","POST"})
     */
    public function index(Request $request)
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('message');
        }
        $errors=$form->getErrors(true);

        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
            'form' => $form->createView(),
            'errors' => $errors
        ]);
    }
}
