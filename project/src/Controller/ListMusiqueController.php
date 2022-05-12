<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Entity\ListMusique;
use App\Entity\Musique;
use App\Form\ListMusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function showListMusique(int $id, Request $request): Response
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

        $form = $this->createFormBuilder()
            ->add('artist', TextType::class)
            ->add('album', TextType::class)
            ->add('annee', NumberType::class)
            ->add('style', TextType::class)
            ->add('titre',  TextType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys

            $musique = new Musique();
            $tmp = $form->getData();
            $musique->setAlbum($tmp['album']);
            $musique->setArtist($tmp['artist']);
            $musique->setAnnee($tmp['annee']);
            $musique->setStyle($tmp['style']);
            $musique->setTitre($tmp['titre']);
            $musique->setIdListmusique($list);

            return $this->redirect($this->generateUrl('add_ListMusique', array('id' => $id, 'musique' => $musique)));
        }

        return $this->render('list_musique/show.html.twig', [
            'list' => $list,
            'musiques' => $musiques,
            'form' => $form->createView(),
        ]);
    }
}
