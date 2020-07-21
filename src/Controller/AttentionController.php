<?php

namespace App\Controller;

use App\Entity\Attention;
use App\Form\AttentionType;
use App\Repository\AttentionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/attention")
 */
class AttentionController extends AbstractController
{
  
    /**
     * @Route("/new", name="attention_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $attention = new Attention();
        $form = $this->createForm(AttentionType::class, $attention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attention);
            $entityManager->flush();

            return $this->redirectToRoute('attention_index');
        }

        return $this->render('attention/new.html.twig', [
            'attention' => $attention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attention $attention): Response
    {
        $form = $this->createForm(AttentionType::class, $attention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('attention_index');
        }

        return $this->render('attention/edit.html.twig', [
            'attention' => $attention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attention_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Attention $attention): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attention->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($attention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('attention_index');
    }
}
