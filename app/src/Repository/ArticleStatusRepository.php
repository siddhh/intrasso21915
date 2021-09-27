<?php

namespace App\Repository;

use App\Entity\ArticleStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleStatus[]    findAll()
 * @method ArticleStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleStatus::class);
    }

    /**
    *  Retourne un status
    * @return ArticleStatus
    */

    public function recuperationStatus(?int $idStatus): ArticleStatus
    {
        $query = $this->createQueryBuilder('a');
        $query
            ->where('a.id = :idStatus')
            ->setParameter('idStatus', $idStatus)
            ;
        return $query->getQuery()->getOneOrNullResult();
    }
}
