<?php

namespace App\Controller\Gestion;

use App\Entity\Nature;
use App\Form\NatureType;
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

class NatureController extends AbstractController
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
     * @Route("/gestion/listeNatures", name="gestion-listeNatures")
     */
    public function listeNatures(Request $request): Response
    {
        $form = $this->createForm(NatureType::class);
        $form->handleRequest($request);
        return $this->render('gestion/listeNatures.html.twig', [
            'form' => $form->createView()
        ]);
    } 

    /**
     * @Route("/gestion/nature/creer", name="gestion-nature-creer")
     */
    public function creerNature(Request $request): Response
    {
        
        $nature = new Nature();
        $form = $this->createForm(NatureType::class, $nature);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nature);
            $em->flush();
            
            $this->addFlash(
                 'success',
                 "la nature {$nature->getLabel()} ajouté."
            ); 
            
            return $this->redirectToRoute('accueil');
        }

        return $this->render('gestion/formNature.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestion/nature/{nature}/modifier", name="gestion-nature-modification")
     */
    public function modifierNature(Request $request, Nature $nature): Response
    {
        // génère le formulaire à partir des données de la nature
        $form = $this->createForm(NatureType::class, $nature);
        // récupère les paramètres fournis par la nature
        $form->handleRequest($request);
        // si valide, on persiste les données du nature en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $nature = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nature);
            $entityManager->flush();
            $this->addFlash(
                'success',
                "Le nature {$nature->getLabel()} a bien été modifié."
            );
            // redirige vers la liste des natures
            return $this->redirectToRoute('gestion-listeNatures');
        }
        // Retourne la page web
        return $this->render('gestion/formNature.html.twig', [
            'form'      => $form->createView(),
            'nature'   => $nature
        ]);
    }
}
