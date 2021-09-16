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
    
    public function listeAuteursNonSupprimés(): array
    {
        
        return $this->createQueryBuilder('a')
        ->where('a.dateSuppression IS NULL')
        ->getQuery()
        ->getResult()
        ;
    }

    // /**
    //  * @return Auteur[] retourne les auteurs en fonction de la vue choisie
    //  */
    
    public function listeAuteurs( string $vueChoisie): array
    {
        $query = $this->createQueryBuilder('a');
        
        if ($vueChoisie == 1) {
            $query->andWhere('a.dateSuppression IS NULL')
            ->orderBy('a.dateSuppression', 'DESC');
        }
        if ($vueChoisie == 2) {
            $query->andWhere('a.dateSuppression IS NOT NULL')
            ->orderBy('a.dateSuppression', 'DESC');
        }
        
        //->where('a.dateSuppression IS NULL')
        //$query->where('a.dateSuppression IS NULL');
        //dd($query);
        return $query->getQuery()->getResult();
    }


    

    // /**
    //  * @return Auteur[] retourne tous les auteurs non supprimés
    //  */
    
    public function listeAuteurSupprime(array $listeAuteurSupprime): array
    {
        
        return $this->createQueryBuilder('a')
        ->where('a.id IN (:listeAuteurSupprime)')
        ->setParameter('listeAuteurSupprime', $listeAuteurSupprime)
        ->getQuery()
        ->getResult()
        ;
    }

    



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
