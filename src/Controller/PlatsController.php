<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Form\PlatsType;
use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping\OrderBy;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @Route("/plats")
 */
class PlatsController extends AbstractController
{
    /**
     * @Route("/{searchBy}", name="plats_index", methods={"GET", "POST"})
     */
    public function index(PlatsRepository $platsRepository, ?string $searchBy = null) : Response
    {
        if (is_null($searchBy)){
            $plats = $platsRepository->findAll();
        }
        elseif ($searchBy === 'desc'){
            $plats = $platsRepository->findByDesc();
        }
        elseif ($searchBy === 'asc'){
            $plats = $platsRepository->findByAsc();
        }
        return $this->render('plats/index.html.twig', [
            'plats' => $plats
        ]);
    }

    /**
     * @Route("/new", name="plats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plat = new Plats();
        $form = $this->createForm(PlatsType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('plats_index');
        }

        return $this->render('plats/new.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plats_show", methods={"GET"})
     */
    public function show(Plats $plat): Response
    {
        return $this->render('plats/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plats $plat): Response
    {
        $form = $this->createForm(PlatsType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plats_index', [
                'id' => $plat->getId(),
            ]);
        }

        return $this->render('plats/edit.html.twig', [
            'plat' => $plat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plats $plat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plats_index');
    }

    /**
     * @Route("/categorie/{tag}", name="tag_plat", methods={"GET"})
     */
    public function platsCategorie (PlatsRepository $platsRepository, string $tag)
    {
        $allTags = $platsRepository->findByTag($tag);
        return $this->render('plats/tag.html.twig', ['allTags' => $allTags, 'tag' => $tag]);
    }
}
