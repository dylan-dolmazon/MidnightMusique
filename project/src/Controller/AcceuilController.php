<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AcceuilController extends AbstractController
{
    public function index(): Response
    {

        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }

    public function contact(Request $request, MailerInterface $mailer): Response
    {

        $email = (new Email())
            ->from($request->request->get('email'))
            ->to('to@demo.fr')
            ->subject($request->request->get('sender'))
            ->text($request->request->get('message'))
        ;

        $mailer->send($email);
        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
}
