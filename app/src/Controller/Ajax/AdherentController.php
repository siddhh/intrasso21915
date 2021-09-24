<?php

namespace App\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class AdherentController extends AbstractController
{
<<<<<<< HEAD
=======
    
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    /**
     * @Route(
     *      "/ajax/adherent/recherche",
     *      methods={"POST"},
     *      name="ajax-adherent-recherche"
     * )
     */
    public function listeAdherents(Request $request)
    {
        $tableauRecherche = [
            'prenom'                => $request->get('Prenom'),
            'nom'                   => $request->get('Nom'),
            'email'                 => $request->get('Email'),
            // 'roles'                 => $request->get('Roles'),
            // 'nbrEmpruntPossible'    => $request->get('NbrEmpruntPossible'),
            // 'isVerified'            => $request->get('IsVerified'),
            // 'actif'                 => $request->get('Actif'),
<<<<<<< HEAD

        ];

        $resultat = $this->getDoctrine()
            ->getRepository(User::class)
            //->findAll();
            ->listeAdherentsTous();
        //->listeAdherentsCriteres($tableauRecherche);
=======
            
        ];

            $resultat = $this->getDoctrine()
            ->getRepository(User::class)
            //->findAll();
            ->listeAdherentsTous();
            //->listeAdherentsCriteres($tableauRecherche);
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

        $reponse = [
            'recherche' => 'liste',
            'donnees' => []
        ];

        foreach ($resultat as $adherent) {
<<<<<<< HEAD
            if ($adherent->getDateSuppression()) {
                $dateSuppression = $adherent->getDateSuppression()->format('d/m/Y');
            } else {
=======
            if ($adherent->getDateSuppression()){
                $dateSuppression = $adherent->getDateSuppression()->format('d/m/Y');
            } else { 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                $dateSuppression = "-";
            }
            $retAdherent = [
                'id'                    => $adherent->getId(),
                'prenom'                => $adherent->getPrenom(),
                'nom'                   => $adherent->getNom(),
                'email'                 => $adherent->getEmail(),
                'roles'                 => $adherent->getRoles(),
                'nbrEmpruntPossible'    => $adherent->getNbrEmpruntPossible(),
                'nbrEmpruntEnCours'     => $adherent->getNbreEmpruntEnCours(),
                'isVerified'            => $adherent->isVerified(),
                'actif'                 => $adherent->getActif(),
                'dateSuppression'       => $dateSuppression
            ];
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $reponse['donnees'][] = $retAdherent;
        }
        return new JsonResponse($reponse);
    }

    // /**
    //  * @Route("/ajax/$adherent/supprimer/{adherent}", methods={"PUT"}, name="ajax-$adherent-supprimer")
    //  */
    // public function supprimer(User $adherent): JsonResponse
    // {

    //     return new JsonResponse(['statut' => 'ok']);
    // }

    /**
     * @Route("/ajax/adherent/supprimer/{adherent}", methods={"PUT"}, name="ajax-adherent-supprimer")
     */
    public function supprimer(User $adherent, Request $request): JsonResponse
    {
        $dateSupression = new \DateTime();
        $dateSupressionString = $dateSupression->format('d/m/Y');
        if (!$adherent->getDateSuppression()) {
            $entityManager = $this->getDoctrine()->getManager();
            $adherent->setDateSuppression($dateSupression);
            $entityManager->flush();

            return new JsonResponse(['statut' => $dateSupressionString]);
<<<<<<< HEAD
        } else {
            return new JsonResponse(['statut' => 'ko']);
            ;
        }
    }
=======

        } else {
            
            return new JsonResponse(['statut' => 'ko']);;
        }
    }

    


>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
}
