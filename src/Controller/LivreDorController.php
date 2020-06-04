<?php

namespace App\Controller;

use App\Entity\LivreDor;
use App\Form\LivreDorType;
use App\Repository\LivreDorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livre/dor")
 */
class LivreDorController extends AbstractController
{
    /**
     * @Route("/", name="livre_dor_index", methods={"GET"})
     */
    public function index(LivreDorRepository $livreDorRepository): Response
    {
        return $this->render('livre_dor/index.html.twig', [
            'livre_dors' => $livreDorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="livre_dor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livreDor = new LivreDor();
        $form = $this->createForm(LivreDorType::class, $livreDor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livreDor);
            $entityManager->flush();

            return $this->redirectToRoute('livre_dor_index');
        }

        return $this->render('livre_dor/new.html.twig', [
            'livre_dor' => $livreDor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_dor_show", methods={"GET"})
     */
    public function show(LivreDor $livreDor): Response
    {
        return $this->render('livre_dor/show.html.twig', [
            'livre_dor' => $livreDor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_dor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LivreDor $livreDor): Response
    {
        $form = $this->createForm(LivreDorType::class, $livreDor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_dor_index');
        }

        return $this->render('livre_dor/edit.html.twig', [
            'livre_dor' => $livreDor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_dor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LivreDor $livreDor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livreDor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livreDor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_dor_index');
    }
}
