<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="add_evenement")
     */
    public function index(?Evenement $evenement, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$evenement) {
            $evenement = new Evenement();
        }

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$evenement->getId()) {
                $entityManagerInterface->persist($evenement);
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('add_evenement'));
        }

        return $this->render('evenement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
