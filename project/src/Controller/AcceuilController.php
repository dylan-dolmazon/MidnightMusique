<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AcceuilController extends AbstractController
{
    public function index(MailerInterface $mailer): Response
    {

        /*$email = (new Email())
            ->from('from@demo.fr')
            ->to('to@demo.fr')
            ->subject('Le petit sujet')
            ->text('ceci est le text du mail')
        ;

        $mailer->send($email);*/

        return $this->render('acceuil/index.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
}
