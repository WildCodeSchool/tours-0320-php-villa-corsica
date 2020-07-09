<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        UserRepository $userRepository
    ): Response {
        $users = $userRepository->findAll();
        if (!empty($users)) {
            return $this->redirectToRoute("app_login");
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setRoles(['ROLE_ADMIN']);
            $password=$form->get('password')->getData();
            $encoded = $encoder->encodePassword($user, $password);
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été enregistré,Connectez-vous sur votre compte');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('user/new.html.twig', ['user' => $user,'form' => $form->createView(),]);
    }
}
