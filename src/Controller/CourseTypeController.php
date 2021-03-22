<?php

namespace App\Controller;

use App\Entity\CourseType;
use App\Form\CourseTypeType;
use App\Repository\CourseTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coursetype")
 */
class CourseTypeController extends AbstractController
{
    /**
     * @Route("/", name="course_type_index", methods={"GET"})
     */
    public function index(CourseTypeRepository $courseTypeRepository): Response
    {
        return $this->render('course_type/index.html.twig', [
            'course_types' => $courseTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="course_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $courseType = new CourseType();
        $form = $this->createForm(CourseTypeType::class, $courseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($courseType);
            $entityManager->flush();

            return $this->redirectToRoute('course_type_index');
        }

        return $this->render('course_type/new.html.twig', [
            'course_type' => $courseType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="course_type_show", methods={"GET"})
     */
    public function show(CourseType $courseType): Response
    {
        return $this->render('course_type/show.html.twig', [
            'course_type' => $courseType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="course_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CourseType $courseType): Response
    {
        $form = $this->createForm(CourseTypeType::class, $courseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_type_index');
        }

        return $this->render('course_type/edit.html.twig', [
            'course_type' => $courseType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="course_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CourseType $courseType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$courseType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($courseType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('course_type_index');
    }
}
