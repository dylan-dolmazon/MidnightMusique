<?php

namespace App\Controller;

use App\Form\ListMusiqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListMusiqueController extends AbstractController
{
    /**
     * @Route("/listmusique", name="app_list_musique")
     */
    public function index(): Response
    {

        $form = $this->createForm(ListMusiqueType::class);

        return $this->render('list_musique/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
