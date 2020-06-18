<?php

namespace App\Controller;

use App\Entity\GoldenBook;
use App\Form\GoldenBookType;
use App\Repository\GoldenBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/golden/book")
 */
class GoldenBookController extends AbstractController
{
    /**
     * @Route("/", name="golden_book_index", methods={"GET","POST"})
     */
    public function index(GoldenBookRepository $goldenBookRepository, Request $request): Response
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
        return $this->render('golden_book/index.html.twig', [
            'golden_books' => $goldenBookRepository->findAll(),
            'form' => $form->createView(),
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
}
