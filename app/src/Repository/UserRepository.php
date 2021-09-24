<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Query;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] retourne tous les adhérents
    //  */

    public function listeAdherentsTous()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.dateSuppression', 'DESC')
            ->addOrderBy('u.isVerified', 'DESC')
            ->addOrderBy('u.actif', 'ASC')

            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Récupère toutes les valeurs sous forme d'un tableau avec comme clé, la clé primaire de l'entrée.
     * @return array
     */
    public function findAllInArray(): array
    {
        return $this->createQueryBuilder("c", "c.id")->getQuery()->getArrayResult();
    }

    /**
    * recherche si libellé composant déjà utilisé avec casse différente
    * @return Composant[]
    */
    public function libelleComposantDejaUtilise(array $champs): array
    {
        dd("$champs");
        return $this->createQueryBuilder('c')
            ->where('UPPER(c.prenom
            ) = :val')
            ->setParameter('val', strtoupper($champs['prenom
            ']))
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * recherche des adherents
     * @return User[]
     */
    public function listeAdministrateursTous(): array
    {
        $query = $this->createQueryBuilder('u')
        ->where('JSON_CONTAINS(u.roles, :roles) = 1')
        ->setParameter('roles', json_encode('ROLE_ADMIN'));

        return $query->getQuery()->getResult();
    }

    /**
     * recherche des adherents
     * @return User[]
     */
    public function listeAdherentsCriteres(array $tableauRecherche = null): array
    {
        $query = $this->createQueryBuilder('u');

        if (!empty($tableauRecherche['prenom'])) {
            $query->andWhere('lower(u.prenom) LIKE :prenom');
            $query->setParameter('prenom', '%'.mb_strtolower($tableauRecherche['prenom']).'%');
        }

        if (!empty($tableauRecherche['nom'])) {
            $query->andWhere('lower(u.nom) LIKE :nom');
            $query->setParameter('nom', '%'.mb_strtolower($tableauRecherche['nom']).'%');
        }

        if (!empty($tableauRecherche['email'])) {
            $query->andWhere('lower(u.email) LIKE :email');
            $query->setParameter('email', '%'.mb_strtolower($tableauRecherche['email']).'%');
        }

        if (!empty($tableauRecherche['roles'])) {
            if ($tableauRecherche['roles'] == 'ROLE_ADMIN') {
                $query->andWhere('JSON_CONTAINS(u.roles, :roles) = 1');
                $query->setParameter('roles', json_encode($tableauRecherche['roles']));
            } else {
                $query->andWhere('JSON_CONTAINS(u.roles, :roles) = 1');
                $query->setParameter('roles', json_encode($tableauRecherche['roles']));
            }
        }

        if (!empty($tableauRecherche['nbrEmpruntPossible'])) {
            $query->andWhere('u.nbrEmpruntPossible =:nbrEmpruntPossible');
            $query->setParameter('nbrEmpruntPossible', $tableauRecherche['nbrEmpruntPossible']);
        }

        // if (!empty($tableauRecherche['isVerified'])) {
        //     $query->andWhere('u.isVerified =:isVerified');
        //     $query->setParameter('isVerified', $tableauRecherche['isVerified']);
        // }

        if (array_key_exists('actif', $tableauRecherche)) {
            $query->andWhere('u.actif =:actif');
            $query->setParameter('actif', $tableauRecherche['actif']);
        }

        //$query->orderby('u.nom', 'ASC');

        return $query->getQuery()->getResult();
    }

    /**
    *  Ajoute un emprunt au compteur d'un adhérent
    * @return User[]
    */

    public function nbreEmpruntEnCours(int $idUser): array
    {
        $query = $this->createQueryBuilder('u');
        $query
            ->where('u.id = :id')
            ->setParameter('id', $idUser)
        ;

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return User[] retourne tous les adhérents en attente de validation
    //  */

    public function listeAdherentsAttenteValidation(): array
    {
        return $this->createQueryBuilder('u')
        ->where('u.isVerified = :true')
        ->setParameter('true', true)
        ->andWhere('u.actif <> :true')
        ->setParameter('true', true)
        ->andWhere('u.dateSuppression IS NULL')
        ->getQuery()
        ->getResult()
        ;
    }
}
