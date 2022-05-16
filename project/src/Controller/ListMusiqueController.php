<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Entity\Evenement;
use App\Entity\ListMusique;
use App\Entity\Musique;
use App\Form\ListMusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ListMusiqueController extends AbstractController
{
    public function index($id, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        $form = $this->createFormBuilder()
            ->add('listName', TextType::class)
            ->add('send', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id);

            $data = $form->getData();

            $listMusique = new ListMusique();
            $listMusique->setNomList($data['listName']);
            $listMusique->setIdEvenement($evenement);

            $entityManagerInterface->persist($listMusique);
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('show_evenement'));
        }


        return $this->render('list_musique/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function showListMusique(int $id, PaginatorInterface $paginator, Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(ListMusique::class);

        $list = $repository->find($id);

        $repository = $this->getDoctrine()->getRepository(Appartient::class);

        $appartients = $repository->findBy(array(
            'idList' => $list->getId(),
        ));

        $repository = $this->getDoctrine()->getRepository(Musique::class);

        $donnees = [];
        $cpt = 0;
        foreach ($appartients as $appartient) {
            $donnees[$cpt] = $repository->find($appartient->getIdMusique());
            $cpt++;
        };

        $musiques = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('list_musique/show.html.twig', [
            'list' => $list,
            'musiques' => $musiques,
            'appartient' => $appartients,
        ]);
    }
}
