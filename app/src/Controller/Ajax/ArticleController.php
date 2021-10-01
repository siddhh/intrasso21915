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

        $tableauRecherche = [
            'titre'                 => $request->get('Titre'),
            'natures'               => $request->get('Natures'),
            'genre'                 => $request->get('Genre'),
            'auteur'                => $request->get('Auteur'),
            'langage'               => $request->get('Langage'),
            'estEmprunte'           => $request->get('estEmprunte'),
        ];
        $resultat = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        //->listeArticlesCriteres($tableauRecherche);

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
            if ($article->getReservePar()) {
                $reservePar = $article->getReservePar()->getNomCompletCourt();
            } else {
                $reservePar = "-";
            }

            $retArticle = [

                'image'                 => $article->getImage(),
                'id'                    => $article->getId(),
                'titre'                 => $article->getTitre(),
                'statusLabel'           => $article->getStatus()->getLabel(),
                'statusId'              => $article->getStatus()->getId(),
                'natures'               => $naturesLibelles,
                'genres'                => $genresLibelles,
                'auteurs'               => $auteursLibelles,
                'langages'              => $langagesLibelles,
                'proprietaire'          => $article->getProprietaire()->getNomCompletCourt(),
                'estEmprunte'           => $article->getEstEmprunte(),
                'emprunteur'            => $nomEmprunteur,
                'dateRestitution'       => $dateRestitution,
                'reservePar'            => $reservePar,                
            ];

            $reponse['donnees'][] = $retArticle;
            $naturesLibelles = [];
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

        $resultat = $this->getDoctrine()
        ->getRepository(Article::class)
        ->listeArticlesEmpruntes($adherentCourant);



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

        return new JsonResponse($reponse);
    }
}
