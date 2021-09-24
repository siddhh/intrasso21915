<?php

namespace App\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Auteur;

class AuteurController extends AbstractController
{
<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    /**
     * @Route(
     *      "/ajax/auteur/recherche",
     *      methods={"POST"},
     *      name="ajax-auteur-recherche"
     * )
     */
    public function listeAuteurs(Request $request)
    {
        $vueChoisie = $request->get('VueChoisie');
        $reponse = [];
        $resultat = $this->getDoctrine()
        ->getRepository(Auteur::class)
        ->listeAuteurs($vueChoisie);

        foreach ($resultat as $auteur) {
<<<<<<< HEAD
=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            if ($auteur->getPrenom()) {
                $prenom = $auteur->getPrenom();
            } else {
                $prenom = "-";
            }

            if ($auteur->getDateSuppression()) {
                $dateSuppression = $auteur->getDateSuppression()->format('d/m/Y');
            } else {
                $dateSuppression = "-";
            }
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $reponse[] = [
                'id'                => $auteur->getId(),
                'prenom'            => $prenom,
                'nom'               => $auteur->getNom(),
                'dateSuppression'   => $dateSuppression,
            ];
        }
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return new JsonResponse($reponse);
    }

    /**
     * @Route(
     *      "/ajax/auteur/suppression",
     *      methods={"POST"},
     *      name="ajax-auteur-suppression"
     * )
     */
    public function listeAuteursSuppression(Request $request)
    {
        $reponse = [];
        $dateSupression = new \DateTime();
        $entityManager = $this->getDoctrine()->getManager();

        $resultat = $this->getDoctrine()
        ->getRepository(Auteur::class)
        ->listeAuteurSupprime($request->get('ListeAuteurSupprime'));

        //dd("STOP");

        foreach ($resultat as $auteur) {
            $auteur->setDateSuppression($dateSupression);
            $entityManager->persist($auteur);
        }
        $entityManager->flush();

<<<<<<< HEAD

        return new JsonResponse(['statut' => 'OK']);
        ;
    }
=======
        
        return new JsonResponse(['statut' => 'OK']);;
    }



>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
}
