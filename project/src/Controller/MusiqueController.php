<?php

namespace App\Controller;

use App\Entity\Musique;
use App\Form\MusiqueType;
use App\Service\CallApiService;
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

    public function addMusique(?Musique $musique, Request $request, EntityManagerInterface $entityManagerInterface, CallApiService $callApiService): Response
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

            return $this->redirect($this->generateUrl('add_musique'));
        }

        $searchform = $this->createFormBuilder()
            ->add('Artiste', TextType::class, array(
                    'required' => true,
                   'attr' => array(
                       'placeholder' => 'Artiste',
                    )
                )
            )
            ->add('Search', ChoiceType::class, [
                'choices' => [
                    'Titre' => 'titre',
                    'Album' => 'album',
                ],
                'attr' => array(
                    'class' => 'dropdown-select'
                )
            ])
            ->add('Choice', TextType::class, array(
                    'required' => false,
                    'attr' => array(
                        'placeholder' => 'Nom',
                    )
                )
            )

            ->add('send', SubmitType::class, array(
                'attr' => array(
                    'class' => 'glow-on-hover'
                )
            ))
            ->getForm();

        $searchform->handleRequest($request);
        if ($searchform->isSubmitted() && $searchform->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $searchform->getData();

            if(isset($data['Choice'])){
                if($data['Search'] === 'album'){
                    $resultat = $callApiService->getData('album',$data);
                }else{
                    $resultat = $callApiService->getData('musique',$data);
                }
            }else {
                $resultat = $callApiService->getData('artiste',$data);
            }
            dump($resultat);
            die;
        }

        return $this->render('musique/index.html.twig', [
            'form' => $form->createView(),
            'searchform' => $searchform->createView()
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
            ->add('search', ChoiceType::class, [
                'choices' => [
                    'Artist' => 'artist',
                    'Titre' => 'titre',
                    'Album' => 'album',
                    'Style' => 'style',
                    'Annee' => 'annee',
                ],
                'attr' => array(
                    'class' => 'dropdown-select'
                )
            ])
            ->add('data', TextType::class, [
                'required' => true,
            ])
            ->add('send', SubmitType::class, array(
                'attr' => array(
                    'class' => 'glow-on-hover'
                )
            ))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();

            $donnees = $this->getDoctrine()->getRepository(Musique::class)->findBy(array($data['search'] => $data['data']), array('id' => 'ASC'));
            $musiques = $paginator->paginate(
                $donnees,
                1,
                count($donnees)
            );
        }

        return $this->render('musique/catalogue.html.twig', [
            'musiques' => $musiques,
            'form' => $form->createView(),
        ]);
    }

    public function deleteMusique($id, EntityManagerInterface $entitymanager)
    {
        $toDelete = $this->getDoctrine()->getRepository(Musique::class)->find($id);
        $entitymanager->remove($toDelete);
        $entitymanager->flush();

        return $this->redirect($this->generateUrl('show_musique'));
    }

    public function modificationMusique($id)
    {
    }
}
