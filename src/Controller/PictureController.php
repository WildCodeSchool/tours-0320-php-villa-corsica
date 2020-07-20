<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Villa;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use GrumPHP\Util\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="picture_index", methods={"GET"})
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="picture_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $manager, Villa $villa): Response
    {
        $picture = new Picture();
        $currentDir = getcwd();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file=$form->get('photoFile')->getData();
            $fileEx=$file->guessExtension();
            $safeFileName='photo';
            $number=1;
            $newFilename=$safeFileName.$number.'.'.$fileEx;
            while (file_exists($this->getParameter('pictures_directory').$newFilename)) {
                $number++;
                $newFilename=$safeFileName.$number.'.'.$fileEx;
            }
            $villaName = $villa->getName();
            // Initialisation de la variable $villaNewName
            $villaNewName = '';
            if (!empty($villaName)) {
                $villaNewName = strtolower($villaName);
            }
            $picFolder = $currentDir . '/pictures/' . $villaNewName;
            $file->move(
                $picFolder,
                $newFilename
            );
            $picName = '/pictures/' . $villaNewName . '/' . $newFilename;
            $picture->setPhoto($picName);
            $picture->setVilla($villa);
            $manager->persist($picture);
            $manager->flush();
            $this->addFlash('success', 'Votre photo a bien été ajouté');
            return $this->redirectToRoute('villa_index');
        }
        return $this->render('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Picture $picture): Response
    {
        $currentFolder = getcwd();

        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            unlink($currentFolder.$picture->getPhoto());
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Votre photo a bien été supprimé');
        return $this->redirectToRoute('picture_index');
    }
}
