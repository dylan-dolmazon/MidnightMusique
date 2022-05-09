<?php

namespace App\Controller;

use App\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="app_evenement")
     */
    public function index(): Response
    {

        $form = $this->createForm(EvenementType::class);

        return $this->render('evenement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
