<?php

namespace App\Controller;

use App\Entity\Condition;
use App\Form\ConditionType;
use App\Repository\ConditionRepository;
use App\Repository\InstructionRepository;
use App\Repository\AttentionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/condition")
 */
class ConditionController extends AbstractController
{
    /**
     * @Route("/", name="condition_index", methods={"GET"})
     */
    public function index(
        ConditionRepository $condition,
        AttentionRepository $attention,
        InstructionRepository $instruction
    ): Response {
        return $this->render('condition/index.html.twig', [
            'conditions' => $condition->findAll(),
            'attentions' => $attention->findAll(),
            'instructions' => $instruction->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="condition_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $condition = new Condition();
        $form = $this->createForm(ConditionType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($condition);
            $manager->flush();

            return $this->redirectToRoute('condition_index');
        }

        return $this->render('condition/new.html.twig', [
            'condition' => $condition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="condition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Condition $condition, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ConditionType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('condition_index');
        }

        return $this->render('condition/edit.html.twig', [
            'condition' => $condition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="condition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Condition $condition, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condition->getId(), $request->request->get('_token'))) {
            $manager->remove($condition);
            $manager->flush();
        }

        return $this->redirectToRoute('condition_index');
    }
}
