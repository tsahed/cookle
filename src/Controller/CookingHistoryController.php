<?php

namespace App\Controller;

use App\Entity\CookingHistory;
use App\Form\CookingHistoryType;
use App\Repository\CookingHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cooking/history")
 */
class CookingHistoryController extends AbstractController
{
    /**
     * @Route("/", name="cooking_history_index", methods={"GET"})
     */
    public function index(CookingHistoryRepository $cookingHistoryRepository): Response
    {
        return $this->render('cooking_history/index.html.twig', [
            'cooking_histories' => $cookingHistoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cooking_history_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cookingHistory = new CookingHistory();
        $form = $this->createForm(CookingHistoryType::class, $cookingHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cookingHistory);
            $entityManager->flush();

            return $this->redirectToRoute('cooking_history_index');
        }

        return $this->render('cooking_history/new.html.twig', [
            'cooking_history' => $cookingHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cooking_history_show", methods={"GET"})
     */
    public function show(CookingHistory $cookingHistory): Response
    {
        return $this->render('cooking_history/show.html.twig', [
            'cooking_history' => $cookingHistory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cooking_history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CookingHistory $cookingHistory): Response
    {
        $form = $this->createForm(CookingHistoryType::class, $cookingHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cooking_history_index');
        }

        return $this->render('cooking_history/edit.html.twig', [
            'cooking_history' => $cookingHistory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cooking_history_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CookingHistory $cookingHistory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cookingHistory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cookingHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cooking_history_index');
    }
}
