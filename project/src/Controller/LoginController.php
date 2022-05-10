<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginController extends AbstractController
{

    /**
     * @Route("/login/root")
     */
    public function login(?User $user, Request $request, NotifierInterface $notifier, Session $session): Response
    {
        if (!$session->start()) {
            if (!$user) {
                $user = new User();
            }
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $repository = $this->getDoctrine()->getRepository(User::class);
                $user = $repository->findOneBy(array('username' => $user->getUsername(), 'password' => $user->getPassword()));
                if ($user === null) {
                    $notifier->send(new Notification("L'utilisateur que vous recherchez n'existe pas", ['browser']));
                } else {
                    $session->start();
                    $session->set('user', $user->getUsername());
                    $session->set('role', $user->getRole());
                    return $this->render('login/connected.html.twig', [
                        'username' => $session->get('user'),
                        'role' => $session->get('role'),
                    ]);
                }
            }

            return $this->render('login/index.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('login/connected.html.twig', [
                'username' => $session->get('user'),
                'role' => $session->get('role'),
            ]);
        }
    }

    public function logout(Session $session, ?User $user, Request $request)
    {
        $session->clear();
        $router = new UrlGeneratorInterface();
        return $router->generate('evenement');
    }
}
