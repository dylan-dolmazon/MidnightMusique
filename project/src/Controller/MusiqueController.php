<?php

namespace App\Controller;

use App\Entity\Musique;
use App\Form\MusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusiqueController extends AbstractController
{
    /**
     * @Route("/musique", name="musique_add")
     */

    public function index(?Musique $musique, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$musique) {
            $musique = new Musique();
        }

        $form = $this->createForm(MusiqueType::class, $musique);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$musique->getId()) {
                $entityManagerInterface->persist($musique);
            }
            $entityManagerInterface->flush();

            return $this->redirect($this->generateUrl('musique_add'));
        }

        return $this->render('musique/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
