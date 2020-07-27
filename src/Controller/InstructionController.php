<?php

namespace App\Controller;

use App\Entity\Instruction;
use App\Form\InstructionType;
use App\Repository\InstructionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/instruction")
 */
class InstructionController extends AbstractController
{

    /**
     * @Route("/new", name="instruction_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $instruction = new Instruction();
        $form = $this->createForm(InstructionType::class, $instruction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($instruction);
            $manager->flush();

            return $this->redirectToRoute('instruction_index');
        }

        return $this->render('instruction/new.html.twig', [
            'instruction' => $instruction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="instruction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Instruction $instruction, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(InstructionType::class, $instruction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('instruction_index');
        }

        return $this->render('instruction/edit.html.twig', [
            'instruction' => $instruction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Instruction $instruction, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instruction->getId(), $request->request->get('_token'))) {
            $manager->remove($instruction);
            $manager->flush();
        }

        return $this->redirectToRoute('instruction_index');
    }
}
