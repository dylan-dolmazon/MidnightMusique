<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AvisController extends AbstractController
{
    public function index(PaginatorInterface $paginator, Request $request, ?Avis $datas, EntityManagerInterface $entityManagerInterface): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Avis::class)->findBy(array(), array('createdAt' => 'ASC'));

        $avis = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            5
        );

        if(!$datas){
            $datas = new Avis();
        }

        $form = $this->createForm(AvisType::class, $datas);

        $form->add('save', SubmitType::class, array(
            'attr' => array(
                'class' => 'glow-on-hover'
            )
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$datas->getId()) {
                dump($datas);
                die;
                $entityManagerInterface->persist($datas);
            }
            $entityManagerInterface->flush();
        }

        return $this->render('avis/index.html.twig', [
            'avis' => $avis,
            'form' => $form->createView(),
        ]);
    }
}
