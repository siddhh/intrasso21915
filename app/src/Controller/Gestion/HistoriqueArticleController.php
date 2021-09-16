<?php

namespace App\Controller\Gestion;

use App\Entity\HistoriqueArticle;
use App\Entity\Article;
use App\Form\HistoriqueArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;

class HistoriqueArticleController extends AbstractController
{
    /** @var EntityManagerInterface  */
    private $em;
 
    /**
     * Constructeur de la commande.
     * Permet notamment de récupérer dépendances
     * @param EntityManagerInterface $em
     */

    public function __construct(
        EntityManagerInterface $em
       
        ) {
            $this->em = $em;
        }

    /**
     * @Route("/gestion/ListeHistorique/{article}", name="gestion-ListeHistoriqueArticle")
     */
    public function listeHistoriqueArticle(Article $article): Response
    {
        // Récupère la liste des services
        $ligneHistoriqueArticle = $this->getDoctrine()->getRepository(HistoriqueArticle::class)->historiquePourUnArticle($article->getId());
        return $this->render('gestion/listeHistoriqueArticle.html.twig', [
            'ligneHistoriqueArticle' => $ligneHistoriqueArticle,
        ]);
    }
}
