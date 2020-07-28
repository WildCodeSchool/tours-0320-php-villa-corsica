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
use Doctrine\ORM\EntityManagerInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/attention")
 */
class AttentionController extends AbstractController
{
  
    /**
     * @Route("/new", name="attention_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $attention = new Attention();
        $form = $this->createForm(AttentionType::class, $attention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($attention);
            $manager->flush();

            return $this->redirectToRoute('condition_index');
        }

        return $this->render('attention/new.html.twig', [
            'attention' => $attention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="attention_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Attention $attention, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AttentionType::class, $attention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('condition_index');
        }

        return $this->render('attention/edit.html.twig', [
            'attention' => $attention,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="attention_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Attention $attention, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attention->getId(), $request->request->get('_token'))) {
            $manager->remove($attention);
            $manager->flush();
        }

        return $this->redirectToRoute('condition_index');
    }
}
