<?php

namespace App\Repository;

use App\Entity\HistoriqueArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoriqueArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueArticle[]    findAll()
 * @method HistoriqueArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueArticle::class);
    }

    /**
    *  Retourne l'historique d'un article
    * @return HistoriqueArticle[]
    */
    
    public function historiquePourUnArticle (int $idArticle): array
    {
        $query = $this->createQueryBuilder('h');
        $query
        ->addSelect(['a'])
        ->leftJoin('h.article', 'a')
        ->where('a.id = :id')
        ->setParameter('id', $idArticle)
            ->orderBy('h.dateAction', 'ASC')
            ;
        return $query->getQuery()->getResult();

        // $query = $this->getEntityManager()->createQuery(
        //     'SELECT 
        //     FROM App\Entity\HistoriqueArticle h
        //     WHERE h.article = :idArticle')->setParameter('idArticle', $idArticle);

        // return $query->getResult();

    }


    

    // /**
    // *  Retourne la liste des articles empruntés
    // * @return HistoriqueArticle[]
    // */
    
    // public function listeArticlesEmpruntes(?int $adherentCourant): array
    // {
    //     $query = $this->createQueryBuilder('h');
    //     $query
    //     ->addSelect(['a'])
    //     ->leftJoin('h.article', 'a')
    //     ->where('a.id = :id')
    //     ->setParameter('id', $adherentCourant)
    //     ->orderBy('h.dateAction', 'ASC')
    //         ;
    //     return $query->getQuery()->getResult();

    //     // $query = $this->getEntityManager()->createQuery(
    //     //     'SELECT 
    //     //     FROM App\Entity\HistoriqueArticle h
    //     //     WHERE h.article = :idArticle')->setParameter('idArticle', $idArticle);

    //     // return $query->getResult();

    // }




    /*
    public function findOneBySomeField($value): ?HistoriqueArticle
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
