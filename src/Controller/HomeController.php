<?php

namespace App\Controller;

use App\Repository\VillaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(VillaRepository $villaRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'villas' => $villaRepository->findAll(),
        ]);
    }
}
