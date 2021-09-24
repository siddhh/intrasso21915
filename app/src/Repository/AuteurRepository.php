<?php

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    // /**
    //  * @return Auteur[] retourne tous les auteurs non supprimés
    //  */
<<<<<<< HEAD

    public function listeAuteursNonSupprimés(): array
    {
=======
    
    public function listeAuteursNonSupprimés(): array
    {
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return $this->createQueryBuilder('a')
        ->where('a.dateSuppression IS NULL')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return Auteur[] retourne les auteurs en fonction de la vue choisie
    //  */
<<<<<<< HEAD

    public function listeAuteurs(string $vueChoisie): array
    {
        $query = $this->createQueryBuilder('a');

=======
    
    public function listeAuteurs( string $vueChoisie): array
    {
        $query = $this->createQueryBuilder('a');
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        if ($vueChoisie == 1) {
            $query->andWhere('a.dateSuppression IS NULL')
            ->orderBy('a.dateSuppression', 'DESC');
        }
        if ($vueChoisie == 2) {
            $query->andWhere('a.dateSuppression IS NOT NULL')
            ->orderBy('a.dateSuppression', 'DESC');
        }
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        //->where('a.dateSuppression IS NULL')
        //$query->where('a.dateSuppression IS NULL');
        //dd($query);
        return $query->getQuery()->getResult();
    }


<<<<<<< HEAD

=======
    
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

    // /**
    //  * @return Auteur[] retourne tous les auteurs non supprimés
    //  */
<<<<<<< HEAD

    public function listeAuteurSupprime(array $listeAuteurSupprime): array
    {
=======
    
    public function listeAuteurSupprime(array $listeAuteurSupprime): array
    {
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return $this->createQueryBuilder('a')
        ->where('a.id IN (:listeAuteurSupprime)')
        ->setParameter('listeAuteurSupprime', $listeAuteurSupprime)
        ->getQuery()
        ->getResult()
        ;
    }

<<<<<<< HEAD

=======
    
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b



    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
