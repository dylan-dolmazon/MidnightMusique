<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AvisController extends AbstractController
{
    public function index(): Response
    {

        $tmp  = new DateTime();

        return $this->render('avis/index.html.twig', [
            'note' => 3,
            'date' => $tmp,
        ]);
    }
}
