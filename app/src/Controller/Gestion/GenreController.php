<?php

namespace App\Controller\Gestion;

use App\Entity\Genre;
use App\Form\GenreType;
use App\Form\RechercheGenreType;
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

class GenreController extends AbstractController
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
     * @Route("/gestion/listeGenres", name="gestion-listeGenres")
     */
    public function listeGenres(Request $request): Response
    {
        $form = $this->createForm(RechercheGenreType::class);
        $form->handleRequest($request);
        return $this->render('gestion/listeGenres.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gestion/genre/creer", name="gestion-genre-creer")
     */
    public function creerGenre(Request $request): Response
    {
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            $this->addFlash(
                'success',
                "Genre ajouté."
            );

            return $this->redirectToRoute('accueil');
        }

        return $this->render('gestion/formGenre.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestion/genre/{genre}/modifier", name="gestion-genre-modification")
     */
    public function modifierNature(Request $request, Genre $genre): Response
    {// génère le formulaire à partir des données de la genre
        $form = $this->createForm(GenreType::class, $genre);
        // récupère les paramètres fournis par la genre
        $form->handleRequest($request);
        // si valide, on persiste les données du genre en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $genre = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($genre);
            $entityManager->flush();
            $this->addFlash(
                'success',
                "Le genre {$genre->getLabel()} a bien été modifié."
            );
            // redirige vers la liste des genres
            return $this->redirectToRoute('gestion-listeGenres');
        }
        // Retourne la page web
        return $this->render('gestion/formGenre.html.twig', [
            'form'      => $form->createView(),
            'genre'   => $genre
        ]);
    }
}
