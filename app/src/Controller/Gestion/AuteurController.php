<?php

namespace App\Controller\Gestion;

use App\Entity\Auteur;
use App\Form\AuteurType;
use App\Form\RechercheAuteurType;
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

class AuteurController extends AbstractController
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
     * @Route("/gestion/listeAuteurs", name="gestion-listeAuteurs")
     */
    public function listeAuteurs(Request $request): Response
    {
        $form = $this->createForm(RechercheAuteurType::class);
        $form->handleRequest($request);
        return $this->render('gestion/listeAuteurs.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gestion/auteur/creer", name="gestion-auteur-creer")
     */
    public function creerAuteur(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            $this->addFlash(
                'success',
                "L'auteur {$auteur->getPrenom()} {$auteur->getNom()} a été ajouté."
            );

            return $this->redirectToRoute('gestion-auteur-creer');
        }

        return $this->render('gestion/formAuteur.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestion/auteur/{auteur}/modifier", name="gestion-auteur-modification")
     */
     //public function modifierAuteur(Request $request, User $auteur, ?UserInterface $userConnecte): Response
    //{


    //}
}
