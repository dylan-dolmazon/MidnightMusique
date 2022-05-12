<?php

namespace App\Controller;

use App\Entity\ListMusique;
use App\Entity\Musique;
use App\Form\MusiqueType;
use App\Form\ListMusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function showListMusique(int $id, ?Musique $musique): Response
    {

        $repository = $this->getDoctrine()->getRepository(ListMusique::class);

        $list = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository(Musique::class);

        $musiques = $repository->findBy(array(
            'idListmusique' => $list->getId(),
        ));

        if (!$musique) {
            $musique = new Musique();
        }

        return $this->render('list_musique/show.html.twig', [
            'list' => $list,
            'musiques' => $musiques,
        ]);
    }
}
