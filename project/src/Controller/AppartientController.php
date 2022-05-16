<?php

namespace App\Controller;

use App\Entity\Appartient;
use App\Entity\ListMusique;
use App\Entity\Musique;
use App\Form\AppartientType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartientController extends AbstractController
{
    /**
     * @Route("/appartient", name="add_appartient")
     */
    public function index(?Appartient $appartient, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        if (!$appartient) {
            $appartient = new Appartient();
        }

        $form = $this->createForm(AppartientType::class, $appartient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$appartient->getId()) {
                $entityManagerInterface->persist($appartient);
            }
            $entityManagerInterface->flush();
            return $this->redirect($this->generateUrl('add_appartient'));
        }

        return $this->render('appartient/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function addAppartient($id, Request $request, EntityManagerInterface $entity, ?int $idMusique)
    {
        $musique = new Musique();
        if (!$idMusique) {
            $repository = $this->getDoctrine()->getRepository(Musique::class);

            $musique = $repository->findOneBy(array(
                'titre' => $request->request->get('titre'),
                'artist' => $request->request->get('artist'),
            ));
            if ($musique == null) {
                $musique = new Musique();
                $musique->setTitre($request->request->get('titre'));
                $musique->setArtist($request->request->get('artist'));
                $musique->setAlbum($request->request->get('album'));
                $musique->setAnnee((int)$request->request->get('annee'));
                $musique->setStyle($request->request->get('style'));
                $entity->persist($musique);
                $entity->flush();
            } else {
                $idMusique = $musique->getId();
            }
        }

        $appartient = new Appartient();

        $repository = $this->getDoctrine()->getRepository(ListMusique::class);

        $list = $repository->find($id);
        $appartient->setIdList($list);
        $appartient->setIdMusique($musique);
        $appartient->setImportance($request->request->get('importance'));
        $entity->persist($appartient);
        $entity->flush();
        return $this->redirect($this->generateUrl('show_ListMusique', array('id' => $id)));
    }
}
