<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findAll()
    {
        return $this->findBy(array(), array('emprunteur' => 'DESC', 'titre' => 'ASC'));
    }

    /**
    *  Retourne la liste des articles empruntés
    * @return Article[]
    */
    
    public function listeArticlesEmpruntes(?int $adherentCourant): array
    {
        $query = $this->createQueryBuilder('a');
        $query
            // ->addSelect(['h'])
            // ->leftJoin('a.historiqueArticles', 'h')
            ->where('a.emprunteur = :id')
            ->setParameter('id', $adherentCourant)
            //->orderBy('a.dateAction', 'ASC')
            ;
        return $query->getQuery()->getResult();

        // $query = $this->getEntityManager()->createQuery(
        //     'SELECT 
        //     FROM App\Entity\HistoriqueArticle h
        //     WHERE h.article = :idArticle')->setParameter('idArticle', $idArticle);

        // return $query->getResult();

    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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
