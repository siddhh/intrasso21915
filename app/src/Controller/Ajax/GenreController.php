<?php

namespace App\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;

class GenreController extends AbstractController
{
    /**
     * @Route(
     *      "/ajax/genre/recherche",
     *      methods={"POST"},
     *      name="ajax-genre-recherche"
     * )
     */
    public function listeGenres(Request $request)
    {
        $tableauRecherche = [
            'label'                => $request->get('Label'),
            'natures'                => $request->get('Natures'),
        ];
        $naturesLibelles = [];

        $resultat = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->findAll();

        $reponse = [
            'recherche' => 'liste',
            'donnees' => []
        ];

        foreach ($resultat as $genre) {
            foreach ($genre->getNatures() as $natures) {
                $naturesLibelles[] = $natures->getLabel();
            }
            $retGenre = [
                'id'                => $genre->getId(),
                'label'             => $genre->getLabel(),
                'natures'           => $naturesLibelles,
            ];

            $naturesLibelles = [];

            $reponse['donnees'][] = $retGenre;
        }
        return new JsonResponse($reponse);
    }




    /**
     * @Route(
     *      "/ajax/genreParNature/recherche",
     *      methods={"POST"},
     *      name="ajax-genreParNature-recherche"
     * )
     */
    public function listeArticles(Request $request)
    {
        $resultat = $this->getDoctrine()
            ->getRepository(Genre::class)
            ->listeGenreParNature($request->get('Nature')[0]);

        $reponse = [];

        foreach ($resultat as $nature) {
            $reponse[] = $nature->getId();
        }
        return new JsonResponse($reponse);
    }
}
