<?php

namespace App\Controller;

use App\Entity\Musique;
use App\Form\MusiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MusiqueController extends AbstractController
{
    public function addMusique(?Musique $musique, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$musique) {
            $musique = new Musique();
        }

        $form = $this->createForm(MusiqueType::class, $musique);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$musique->getId()) {
                $entityManagerInterface->persist($musique);
            }
            $entityManagerInterface->flush();

            return $this->redirect($this->generateUrl('musique_add'));
        }

        return $this->render('musique/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function showMusique(Request $request, PaginatorInterface $paginator)
    {
        $donnees = $this->getDoctrine()->getRepository(Musique::class)->findAll();

        $musiques = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            10
        );

        $form = $this->createFormBuilder()
            ->add('importance', ChoiceType::class, [
                'choices' => [
                    'artist' => 'artist',
                    'titre' => 'titre',
                    'album' => 'album',
                    'style' => 'style',
                    'annee' => 'annee',
                ],
            ])
            ->add('data', TextType::class, [
                'required' => true,
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $musiques = $this->getDoctrine()->getRepository(Musique::class)->findBy(array($data['importance'] => $data['data']), array('id' => 'ASC'), 10);
        }

        return $this->render('musique/catalogue.html.twig', [
            'musiques' => $musiques,
            'form' => $form->createView(),
        ]);
    }

    public function increment()
    {
        dump("coucou");
        die;
    }
}
