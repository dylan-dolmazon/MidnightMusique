<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    public function login(): Response
    {

        $form = $this->createForm(UserType::class);


        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function logout()
    {
    }
}
