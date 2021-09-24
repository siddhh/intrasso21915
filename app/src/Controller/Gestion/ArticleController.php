<?php

namespace App\Controller\Gestion;

use App\Entity\Article;
use App\Entity\User;
use App\Entity\HistoriqueArticle;
use App\Form\ArticleType;
use App\Form\RechercheArticleType;
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
use Symfony\Component\Security\Core\Security;

class ArticleController extends AbstractController
{
    /** @var EntityManagerInterface  */
    private $entityManager;

    /** @var Service */
    private $serviceCourant;


    /**
     * Constructeur de la commande.
     * Permet notamment de récupérer dépendances
     * @param EntityManagerInterface $entityManager
     * @param EntityManagerInterface $serviceCourant
     */

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->serviceCourant = $security->getUser();
    }

    /**
 * @Route("/gestion/listeArticles", name="gestion-listeArticles")
     */
    public function listeArticles(Request $request): Response
    {
        $form = $this->createForm(RechercheArticleType::class);
        $form->handleRequest($request);
        return $this->render('gestion/listeArticles.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/gestion/article/creer", name="gestion-article-creer")
     */
    public function creerArticle(Request $request): Response
    {
        $dateCourante = new \DateTime();
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($article->getImage() !== null) {
                $file = $form->get('image')->getData();
                $fileName =  uniqid(). '.' .$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('image_directory'), // Le dossier dans le quel le fichier va etre charger
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $article->setImage($fileName);
            } else {
                $article->setImage("null");
            }
            //$entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($article);
            $this->entityManager->flush();

            //historisation
            $historiqueArticle = new HistoriqueArticle();
            $historiqueArticle->addAdherent($this->serviceCourant);
            $historiqueArticle->addArticle($article);
            $historiqueArticle->setDateAction($dateCourante);
            $historiqueArticle->setAction("Ajout");
            $this->entityManager->persist($historiqueArticle);
            $this->entityManager->flush();

            $this->addFlash(
                'success',
                "Article {$article->getTitre()} ajouté."
            );

            return $this->redirectToRoute('gestion-article-creer');
        }

        return $this->render('gestion/formArticle.html.twig', [
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestion/article/{article}/modifier", name="gestion-articles-modification")
     * Permet de modifier un article existant
     */
    public function modifierArticle(Request $request, Article $article): Response
    {
        $dateCourante = new \DateTime();
        $oldPicture = $article->getImage();
        // génère le formulaire à partir des données de l'article
        $form = $this->createForm(ArticleType::class, $article);
        // récupère les paramètres fournis par l article
        $form->handleRequest($request);
        // si valide, on persiste l'état du article en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            if ($article->getImage() !== null && $article->getImage() !== $oldPicture) {
                $file = $form->get('image')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('image_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $article->setImage($fileName);
            } else {
                $article->setImage($oldPicture);
            }
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $this->addFlash(
                'success',
                "L'article {$article->getTitre()} a été modifié."
            );
            //historisation
            $historiqueArticle = new HistoriqueArticle();
            $historiqueArticle->addAdherent($this->serviceCourant);
            $historiqueArticle->addArticle($article);
            $historiqueArticle->setDateAction($dateCourante);
            $historiqueArticle->setAction('Modification');
            $this->entityManager->persist($historiqueArticle);
            $this->entityManager->flush();

            // redirige vers la liste des articles
            return $this->redirectToRoute('gestion-listeArticles');
        }
        // Retourne la page web
        return $this->render('gestion/formArticle.html.twig', [
            'form'                          => $form->createView(),
            'article'                       => $article,
        ]);
    }

    /**
     * @Route("/gestion/article/{article}/restituer", name="gestion-article-restituer")
     * Permet de modifier un article existant
     */
    public function restituerArticle(Request $request, Article $article): Response
    {
        $dateCourante = new \DateTime();
        $form = $this->createForm(ArticleType::class, $article);

        // récupère les paramètres fournis par l article
        $form->handleRequest($request);
        $article = $form->getData();
        $article->setEmprunteur(null);
        $article->setEstEmprunte(false);
        $article->setDateRestitution(null);
        $this->entityManager->persist($article);

        //adhérent
        $adherent = $this->getDoctrine()->getRepository(User::class)->nbreEmpruntEnCours($this->serviceCourant->getId());
        $nbreEmpruntEnCours = $adherent[0]->getNbreEmpruntEnCours();
        $adherent[0]->setNbreEmpruntEnCours($nbreEmpruntEnCours-1);
        $this->entityManager->persist($adherent[0]);

        //historisation
        $historiqueArticle = new HistoriqueArticle();
        $historiqueArticle->addAdherent($this->serviceCourant);
        $historiqueArticle->addArticle($article);
        $historiqueArticle->setDateAction($dateCourante);
        $historiqueArticle->setAction("Restituer");
        $this->entityManager->persist($historiqueArticle);

        $this->entityManager->flush();
        $this->addFlash(
            'success',
            "L'article {$article->getTitre()} a bien été restitué."
        );
        // redirige vers la liste des articles
        return $this->redirectToRoute('gestion-listeArticles');
    }

    /**
     * @Route("/gestion/article/{article}/emprunter", name="gestion-article-emprunter")
     * Permet d'emprunter un article existant
     */
    public function emprunterArticle(Request $request, Article $article): Response
    {
        $dateCourante = new \DateTime();
        $dateLimiteRestitution = (new \DateTime('now'))->add(new \DateInterval('P90D'))->setTime(0, 0, 0);
        $form = $this->createForm(ArticleType::class, $article);

        //article
        $form->handleRequest($request);
        $article = $form->getData();
        $article->setEmprunteur($this->serviceCourant);
        $article->setEstEmprunte(true);
        $article->setDateRestitution($dateLimiteRestitution);
        $this->entityManager->persist($article);

        //adhérent
        $adherent = $this->getDoctrine()->getRepository(User::class)->nbreEmpruntEnCours($this->serviceCourant->getId());
        $nbreEmpruntEnCours = $adherent[0]->getNbreEmpruntEnCours();
        $adherent[0]->setNbreEmpruntEnCours($nbreEmpruntEnCours+1);
        $this->entityManager->persist($adherent[0]);

        //historisation
        $historiqueArticle = new HistoriqueArticle();
        $historiqueArticle->addAdherent($this->serviceCourant);
        $historiqueArticle->addArticle($article);
        $historiqueArticle->setDateAction($dateCourante);
        $historiqueArticle->setAction("Emprunter");
        $this->entityManager->persist($historiqueArticle);
        $this->entityManager->flush();

        //message flash
        $this->addFlash(
            'success',
            "L'article {$article->getTitre()} a bien été emprunté."
        );

        return $this->redirectToRoute('gestion-listeArticles');
    }
}
