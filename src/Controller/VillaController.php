<?php

namespace App\Controller;

use App\Entity\Villa;
use App\Model\Booking;
use App\Form\BookingType;
use App\Form\VillaType;
use App\Repository\VillaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @Route("/{id}", name="villa_show", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function show(Villa $villa, Request $request, MailerInterface $mailer): Response
    {
        $booking= new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from($this->getParameter('mailer_from'))
                ->to(new Address($this->getParameter('mailer_to')))
                ->subject('Reservation')
            // path of the Twig template to render
                ->htmlTemplate('email/reservation.html.twig')
           // pass l'object (information et villa) to the template
                ->context([
                   'booking' => $booking,
                   'villa'=>$villa,
                    ]);
            $mailer->send($email);
            // the success flash message
            $this->addFlash('success', 'Votre demande de réservation a été bien envoyée');
            return $this->redirectToRoute('villa_index');
        }
        return $this->render('villa/show.html.twig', [
            'villa' => $villa,
            'form' => $form->createView(),
        ]);
    }
    
     /**
      * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="villa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Villa $villa): Response
    {
        $form = $this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('villa_index');
        }

        return $this->render('villa/edit.html.twig', [
            'villa' => $villa,
            'form' => $form->createView(),
        ]);
    }


    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="villa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Villa $villa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$villa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            unlink($this->getParameter('images_directory').$villa->getPoster());
            $entityManager->remove($villa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('villa_index');
    }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="villa_new")
     */
    public function new(Request $request)
    {
        $villa=new Villa();
        $form=$this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file=$form->get('posterFile')->getData();
            $fileEx=$file->guessExtension();
            $imageName=$villa->getName();
            $newFilename =$imageName.'.'.$fileEx;
            $file->move(
                $this->getParameter('images_directory'),
                $newFilename
            );
            $villa->setPoster($newFilename);
            $entityManager->persist($villa);
            $entityManager->flush();
             // the success flash message
             $this->addFlash('success', 'Votre villa a été bien ajoutée ');
             return $this->redirectToRoute('villa_index');
        }


        return $this->render('villa/new.html.twig', ['form'=>$form->createView(), ]);
    }
}
