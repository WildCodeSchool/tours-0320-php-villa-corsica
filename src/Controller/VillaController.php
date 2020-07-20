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
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;

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
                ->subject('Réservation')
                // path of the Twig template to render
                ->htmlTemplate('email/reservation.html.twig')
                // pass l'object (information et villa) to the template
                ->context([
                    'booking' => $booking,
                    'villa'=>$villa,
                ]);
            $mailer->send($email);
            // the success flash message
            $this->addFlash('success', 'Votre demande de réservation a bien été envoyée');
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
            unlink($this->getParameter('posters_directory').$villa->getPoster());
            $entityManager = $this->getDoctrine()->getManager();
            $file=$form->get('posterFile')->getData();
            $fileEx=$file->guessExtension();
            $imageName=$villa->getName();
            $newFilename = '';
            if (!empty($imageName)) {
                $newFilename = str_replace(' ', '', $imageName).'.'.$fileEx;
                $newFilename = strtolower($newFilename);
            }
            $file->move(
                $this->getParameter('posters_directory'),
                $newFilename
            );
            $villa->setPoster($newFilename);
            $entityManager->flush();
            $this->addFlash('success', 'La villa a bien été mise à jour');
            return $this->redirectToRoute('villa_index');
        }
        return $this->render('villa/edit.html.twig', [
            'villa' => $villa,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="villa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Villa $villa): Response
    {
        $delete = new Filesystem();
        $currentDir = getcwd();
        $folderPath = $currentDir . '/pictures/';

        if ($this->isCsrfTokenValid('delete'.$villa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            unlink($this->getParameter('posters_directory').$villa->getPoster());
            $villaName = $villa->getName();
            $newVillaName = '';
            if (!empty($villaName)) {
                $villaTmpName = str_replace(' ', '', $villaName);
                $newVillaName = strtolower($villaTmpName);
            }
            $delete->remove($folderPath . $newVillaName);
            $entityManager->remove($villa);
            $entityManager->flush();
        }
        $this->addFlash('success', 'La villa a bien été supprimé ');
        return $this->redirectToRoute('villa_index');
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="villa_new")
     */
    public function new(Request $request)
    {
        $villa=new Villa();
        $folder = new Filesystem();
        $currentDir = getcwd();

        $form=$this->createForm(VillaType::class, $villa);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file=$form->get('posterFile')->getData();
            $fileEx=$file->guessExtension();
            $imageName=$villa->getName();
            $newFilename = '';
            if (!empty($imageName)) {
                $tmpFileName = str_replace(' ', '', $imageName).'.'.$fileEx;
                $newFilename = strtolower($tmpFileName);
            }
            $newFolderName = '';
            if (!empty($imageName)) {
                $tmpFolderName =  str_replace(' ', '', $imageName);
                $newFolderName = strtolower($tmpFolderName);
            }
            $newFolderPath = $currentDir . '/pictures/' . $newFolderName;
            if (!$folder->exists($newFolderPath)) {
                $old = umask(0);
                $folder->mkdir($newFolderPath, 0775);
                umask($old);
            } else {
                $this->addFlash('danger', 'Cette villa existe déjà');
                return $this->render('villa/new.html.twig', ['form'=>$form->createView(), ]);
            }
            $file->move(
                $this->getParameter('posters_directory'),
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
