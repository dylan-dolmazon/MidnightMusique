<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login/root")
     */
    public function login(?User $user, Request $request, NotifierInterface $notifier, SessionInterface $session): Response
    {


        if ($session->get('connected') === null) {
            $session->set('connected', false);
        }
        if ($session->get('connected') === false) {
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
                    $session->set('connected', true);
                    $session->save();
                    return $this->render('login/connected.html.twig', [
                        'username' =>  $user->getUsername(),
                        'role' => $user->getRole(),
                    ]);
                }
            }
            return $this->render('login/index.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('login/connected.html.twig', [
                'username' =>  "coucou",
                'role' => "coucou",
            ]);
        }
    }

    public function logout(SessionInterface $session)
    {
        $session->set('connected', false);
        return new RedirectResponse($this->generateUrl('login'));
    }
}
