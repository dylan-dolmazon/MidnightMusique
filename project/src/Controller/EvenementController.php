<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\ListMusique;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class EvenementController extends AbstractController
{

    public function index(): Response
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

        $form->add('save', SubmitType::class, array(
            'attr' => array(
                'class' => 'glow-on-hover'
            )
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if (!$evenement->getId()) {
                $entityManagerInterface->persist($evenement);
                $notifier->send(new Notification("L'évenement à était ajouté à la liste avec succés.", ['browser']));
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('show_evenement'));
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

    public function deleteEvenement($id, EntityManagerInterface $entitymanager)
    {

        $repository = $this->getDoctrine()->getRepository(Evenement::class);

        $toDelete = $repository->find($id);

        $entitymanager->remove($toDelete);
        $entitymanager->flush();

        return $this->redirect($this->generateUrl('show_evenement'));
    }
}
