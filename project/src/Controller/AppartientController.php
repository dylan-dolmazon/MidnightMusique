<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Form\AppartientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartientController extends AbstractController
{
    /**
     * @Route("/appartient", name="add_appartient")
     */
    public function index(?Appartient $appartient, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$appartient) {
            $appartient = new Appartient();
        }

        $form = $this->createForm(AppartientType::class, $appartient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$appartient->getId()) {
                $entityManagerInterface->persist($appartient);
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('add_appartient'));
        }

        return $this->render('appartient/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
