<?php

namespace App\Controller;

use App\Form\AppartientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartientController extends AbstractController
{
    /**
     * @Route("/appartient", name="app_appartient")
     */
    public function index(): Response
    {

        $form = $this->createForm(AppartientType::class);

        return $this->render('appartient/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
