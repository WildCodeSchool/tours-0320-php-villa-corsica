<?php

namespace App\Controller;

use App\Entity\GoldenBook;
use App\Form\GoldenBookType;
use App\Repository\GoldenBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/golden/book")
 */
class GoldenBookController extends AbstractController
{
    /**
     * @Route("/", name="golden_book_index", methods={"GET","POST"})
     */
    public function index(GoldenBookRepository $goldenBookRepository): Response
    {
        return $this->render('golden_book/index.html.twig', [
            'golden_books' => $goldenBookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="golden_book_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $goldenBook = new GoldenBook();
        $form = $this->createForm(GoldenBookType::class, $goldenBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goldenBook);
            $entityManager->flush();

            return $this->redirectToRoute('golden_book_index');
        }

        return $this->render('golden_book/new.html.twig', [
            'golden_book' => $goldenBook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="golden_book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GoldenBook $goldenBook): Response
    {
        $form = $this->createForm(GoldenBookType::class, $goldenBook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('golden_book_index');
        }

        return $this->render('golden_book/edit.html.twig', [
            'golden_book' => $goldenBook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="golden_book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GoldenBook $goldenBook): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goldenBook->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goldenBook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('golden_book_index');
    }
}
