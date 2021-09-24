<?php

namespace App\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Nature;

class NatureController extends AbstractController
{
<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    /**
     * @Route(
     *      "/ajax/nature/recherche",
     *      methods={"POST"},
     *      name="ajax-nature-recherche"
     * )
     */
    public function listeNatures(Request $request)
    {
<<<<<<< HEAD
        $tableauRecherche = [
            'label'                => $request->get('Label'),
            'genres'               => $request->get('Genres'),
        ];
        $genresLibelles = [];

        $resultat = $this->getDoctrine()
=======
        
        $tableauRecherche = [
            'label'                => $request->get('Label'),     
            'genres'               => $request->get('Genres'),       
        ];
        $genresLibelles = [];

            $resultat = $this->getDoctrine()
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            ->getRepository(Nature::class)
            ->findAll();

        $reponse = [
            'recherche' => 'liste',
            'donnees' => []
        ];

        foreach ($resultat as $nature) {
            foreach ($nature->getGenres() as $genre) {
                $genresLibelles[] = $genre->getLabel();
            }
            $retNature = [
                'id'               => $nature->getId(),
                'label'            => $nature->getLabel(),
                'genres'           => $genresLibelles,
            ];
            $genresLibelles = [];
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $reponse['donnees'][] = $retNature;
        }


        return new JsonResponse($reponse);
    }
}
