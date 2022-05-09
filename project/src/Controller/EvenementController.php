<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="add_evenement")
     */
    public function index(?Evenement $evenement, Request $request, EntityManagerInterface $entityManagerInterface, NotifierInterface $notifier): Response
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
}
