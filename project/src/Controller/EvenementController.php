<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ListMusique;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class EvenementController extends AbstractController
{

    public function index(Request $request): Response
    {

        $repository = $this->getDoctrine()->getRepository(Evenement::class);

        $evenements = $repository->findAll();

        return $this->render('evenement/liste.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    public function addEvenement(?Evenement $evenement, Request $request, EntityManagerInterface $entityManagerInterface, NotifierInterface $notifier): Response
    {

        if (!$evenement) {
            $evenement = new Evenement();
        }

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ('submit' === $request->request->get('clicked')) {
                if (!$evenement->getId()) {
                    $entityManagerInterface->persist($evenement);
                    $notifier->send(new Notification("L'évenement à était ajouté à la liste avec succés.", ['browser']));
                }
            } else if ('reset' === $request->request->get('clicked')) {
                $repository = $this->getDoctrine()->getRepository(Evenement::class);
                $del = $repository->findOneBy([
                    'date' => $evenement->getDate(),
                    'lieux' => $evenement->getLieux(),
                ]);
                if ($del != null) {
                    $entityManagerInterface->remove($del);
                    $notifier->send(new Notification("L'évenement à était supprimé avec succés.", ['browser']));
                } else {
                    $notifier->send(new Notification("L'évenement que vous cherchez n'existe pas.", ['browser']));
                }
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('add_evenement'));
        }

        return $this->render('evenement/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function askPassword(Request $request, $id, NotifierInterface $notifier)
    {

        $repository = $this->getDoctrine()->getRepository(Evenement::class);

        $evenement = $repository->findOneBy(array(
            'id' => $id,
            'password' => $request->request->get('password'),
        ));

        if ($evenement === null) {
            $notifier->send(new Notification("Le mot de passe saisit n'est pas correct", ['browser']));
            return new RedirectResponse($this->generateUrl('show_evenement'));
        } else {
            $repository = $this->getDoctrine()->getRepository(ListMusique::class);

            $lists = $repository->findBy(array(
                'idEvenement' => $id
            ));
        }

        $repository = $this->getDoctrine()->getRepository(Evenement::class);

        $evenements = $repository->findAll();

        return $this->render('evenement/liste.html.twig', [
            'evenements' => $evenements,
            'lists' => $lists,
        ]);
    }
}
