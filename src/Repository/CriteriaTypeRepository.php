<?php

namespace App\Repository;

use App\Entity\CriteriaType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CriteriaType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CriteriaType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CriteriaType[]    findAll()
 * @method CriteriaType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CriteriaTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CriteriaType::class);
    }

    // /**
    //  * @return CriteriaType[] Returns an array of CriteriaType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CriteriaType
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
