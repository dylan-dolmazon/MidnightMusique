<?php

namespace App\Controller;

use App\Entity\Avis;
use DateTime;
use Doctrine\Migrations\Version\Direction;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AvisController extends AbstractController
{
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $donnees = $this->getDoctrine()->getRepository(Avis::class)->findBy(array(), array('createdAt' => 'ASC'));

        $avis = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('avis/index.html.twig', [
            'avis' => $avis
        ]);
    }
}
