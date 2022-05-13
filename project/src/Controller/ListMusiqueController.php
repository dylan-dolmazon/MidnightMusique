<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Entity\Evenement;
use App\Entity\ListMusique;
use App\Entity\Musique;
use App\Form\ListMusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ListMusiqueController extends AbstractController
{
    public function index(?ListMusique $listMusique, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$listMusique) {
            $listMusique = new ListMusique();
        }

        $form = $this->createForm(ListMusiqueType::class, $listMusique);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$listMusique->getId()) {
                $entityManagerInterface->persist($listMusique);
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('add_listmusique'));
        }

        return $this->render('list_musique/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function showListMusique(int $id, Request $request, SessionInterface $session): Response
    {
        $repository = $this->getDoctrine()->getRepository(ListMusique::class);

        $list = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository(Appartient::class);

        $appartients = $repository->findBy(array(
            'idList' => $list->getId(),
        ));

        $repository = $this->getDoctrine()->getRepository(Musique::class);

        $musiques = [];
        $cpt = 0;
        foreach ($appartients as $appartient) {
            $musiques[$cpt] = $repository->findOneBy(array(
                'id' => $appartient->getIdMusique(),
            ));
            $cpt++;
        };

        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $evenement = $repository->findOneBy(array(
            'id' => $id,
        ));

        return $this->render('list_musique/show.html.twig', [
            'list' => $list,
            'musiques' => $musiques,
            'appartient' => $appartients,
            'evenement' => $evenement,
        ]);
    }
}
