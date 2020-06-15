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
     * @Route("/{id}", name="villa_show", methods={"GET"})
     */
    public function show(Villa $villa): Response
    {
        return $this->render('villa/show.html.twig', [
            'villa' => $villa,
        ]);
    }
}
