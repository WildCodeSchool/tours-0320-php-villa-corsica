<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Villa;
use App\Model\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact" , methods={"GET","POST"})
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact= new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from($this->getParameter('mailer_from'))
                ->to(new Address($this->getParameter('mailer_to')))
                ->subject('message')
            // path of the Twig template to render
                ->htmlTemplate('email/message.html.twig')
           // pass l'object (information et villa) to the template
                ->context([
                   'contact' => $contact
                    ]);
            $mailer->send($email);
            // the success flash message
            $this->addFlash('success', 'Votre message a été bien envoyé');
            return $this->redirectToRoute('home_index');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
