<?php

namespace App\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\HistoriqueArticle;

class ArticleController extends AbstractController
{
<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    /**
     * @Route(
     *      "/ajax/article/recherche",
     *      methods={"POST"},
     *      name="ajax-article-recherche"
     * )
     */
    public function listeArticles(Request $request)
    {
        $naturesLibelles = [];
        $genresLibelles = [];
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        $tableauRecherche = [
            'titre'                 => $request->get('Titre'),
            'natures'               => $request->get('Natures'),
            'genre'                 => $request->get('Genre'),
            'auteur'                => $request->get('Auteur'),
            'langage'               => $request->get('Langage'),
<<<<<<< HEAD
            'estEmprunte'           => $request->get('estEmprunte'),
        ];
        $resultat = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        //->listeArticlesCriteres($tableauRecherche);
=======
            'estEmprunte'           => $request->get('estEmprunte'),  
        ];
            $resultat = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
            //->listeArticlesCriteres($tableauRecherche);
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

        $reponse = [
            'donnees'   => []
        ];

        foreach ($resultat as $article) {
            foreach ($article->getNatures() as $natures) {
                $naturesLibelles[] = $natures->getLabel();
            }
            foreach ($article->getGenresBis() as $genres) {
                $genresLibelles[] = $genres->getLabel();
            }
            foreach ($article->getAuteurs() as $auteurs) {
                $auteursLibelles[] = $auteurs->getNomCompletCourt();
            }
            foreach ($article->getLangages() as $langages) {
                $langagesLibelles[] = $langages->getLabel();
            }
            if ($article->getEmprunteur()) {
                $nomEmprunteur = $article->getEmprunteur()->getNomCompletCourt();
            } else {
                $nomEmprunteur = "-";
            }
            if ($article->getDateRestitution()) {
                $dateRestitution = $article->getDateRestitution()->format('d/m/Y');
            } else {
                $dateRestitution = "-";
            }

            $retArticle = [

                'image'                 => $article->getImage(),
                'id'                    => $article->getId(),
                'titre'                 => $article->getTitre(),
                'natures'               => $naturesLibelles,
                'genres'                => $genresLibelles,
                'auteurs'               => $auteursLibelles,
                'langages'              => $langagesLibelles,
                'proprietaire'          => $article->getProprietaire()->getNomCompletCourt(),
                'estEmprunte'           => $article->getEstEmprunte(),
                'emprunteur'            => $nomEmprunteur,
                'dateRestitution'       => $dateRestitution,
            ];
<<<<<<< HEAD

            $reponse['donnees'][] = $retArticle;
            $naturesLibelles = [];
=======
            
            $reponse['donnees'][] = $retArticle;
            $naturesLibelles = []; 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $genresLibelles = [];
            $auteursLibelles = [];
            $langagesLibelles = [];
        }

        return new JsonResponse($reponse);
    }

    /**
     * @Route(
     *      "/ajax/gestion/article/listeArticlesEmpruntes",
     *      methods={"GET"},
     *      name="ajax-article-listeArticlesEmpruntes"
     * )
     */
    public function listeArticlesEmpruntes()
    {
        $reponse = [];
        $adherentCourant = $this->getUser()->GetId();
<<<<<<< HEAD

        $resultat = $this->getDoctrine()
        ->getRepository(Article::class)
        ->listeArticlesEmpruntes($adherentCourant);


=======
        
        $resultat = $this->getDoctrine()
        ->getRepository(Article::class)
        ->listeArticlesEmpruntes($adherentCourant);
        
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

        foreach ($resultat as $article) {
            foreach ($article->getNatures() as $natures) {
                $naturesLibelles[] = $natures->getLabel();
            }
            if ($article->getDateRestitution()) {
                $dateRestitution = $article->getDateRestitution()->format('d/m/Y');
            } else {
                $dateRestitution = "-";
            }
            $reponse[] = [
                'natures'                 => implode(",", $naturesLibelles),
                'titre'                  => $article->getTitre(),
                'dateRestitution'        => $dateRestitution,
            ];
        }

        //dd($reponse, $resultat);
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return new JsonResponse($reponse);
    }
}
