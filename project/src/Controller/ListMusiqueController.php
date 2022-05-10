<?php

namespace App\Controller;

use App\Entity\ListMusique;
use App\Form\ListMusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    public function showListMusique(int $id): Response
    {

        $repository = $this->getDoctrine()->getRepository(ListMusique::class);

        $list = $repository->find($id);

        return $this->render('list_musique/show.html.twig', [
            'list' => $list,
        ]);
    }
}
