<?php

namespace App\Controller;

use App\Entity\Villa;
use App\Form\VillaType;
use App\Repository\VillaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/villa")
 */
class VillaController extends AbstractController
{
    /**
     * @Route("/", name="villa_index", methods={"GET"})
     */
    public function index(VillaRepository $villaRepository): Response
    {
        return $this->render('villa/index.html.twig', [
            'villas' => $villaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="villa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $villa = new Villa();
        $form = $this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($villa);
            $entityManager->flush();

            return $this->redirectToRoute('villa_index');
        }

        return $this->render('villa/new.html.twig', [
            'villa' => $villa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="villa_show", methods={"GET"}, requirements={"id"="[0-9]"})
     */
    public function show(Villa $villa): Response
    {
        return $this->render('villa/show.html.twig', [
            'villa' => $villa,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="villa_edit", methods={"GET","POST"}, requirements={"id"="[0-9]"})
     */
    public function edit(Request $request, Villa $villa): Response
    {
        $form = $this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('villa_index');
        }

        return $this->render('villa/edit.html.twig', [
            'villa' => $villa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="villa_delete", methods={"DELETE"}, requirements={"id"="[0-9]"})
     */
    public function delete(Request $request, Villa $villa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$villa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($villa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('villa_index');
    }
}
