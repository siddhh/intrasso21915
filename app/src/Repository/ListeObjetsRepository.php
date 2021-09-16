<?php

namespace App\Repository;

//use App\Entity\ListeObjets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * @method ListeObjets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeObjets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeObjets[]    findAll()
 * @method ListeObjets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeObjetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeObjets::class);
    }

    /**
     * recherche des articles
     * @return User[]
     */
    public function listeArticlesCriteres(array $tableauRecherche = null): array
    {

        $query = $this->createQueryBuilder('a');
       
        if (!empty($tableauRecherche['titre'])) {
            $query->andWhere('lower(a.tr) LIKE :titre');
            $query->setParameter('titre', '%'.mb_strtolower($tableauRecherche['prenom']).'%');
        }

        if (!empty($tableauRecherche['description'])) {
            $query->andWhere('lower(a.description) LIKE :description');
            $query->setParameter('description', '%'.mb_strtolower($tableauRecherche['description']).'%');
        }

        if (!empty($tableauRecherche['categorie'])) {
            $query->andWhere('lower(a.categorie) LIKE :categorie');
            $query->setParameter('emacategorieil', '%'.mb_strtolower($tableauRecherche['categorie']).'%');
        }

        if (!empty($tableauRecherche['auteurs'])) {
            if ($tableauRecherche['auteurs'] == 'ROLE_ADMIN') {
                $query->andWhere('JSON_CONTAINS(a.auteurs, :auteurs) = 1');
                $query->setParameter('auteurs', json_encode($tableauRecherche['auteurs']));
            }
        }

        if (!empty($tableauRecherche['estEmprunte'])) {
            $query->andWhere('a.estEmprunte =:estEmprunte');
            $query->setParameter('estEmprunte', $tableauRecherche['estEmprunte']);
        }

        
        //$query->orderby('a.nom', 'ASC');

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return ListeObjets[] Returns an array of ListeObjets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeObjets
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
