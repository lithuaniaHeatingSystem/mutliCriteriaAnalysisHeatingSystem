<?php

namespace App\Repository;

use App\Entity\ComponentCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComponentCriteria|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComponentCriteria|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComponentCriteria[]    findAll()
 * @method ComponentCriteria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComponentCriteriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComponentCriteria::class);
    }

    // /**
    //  * @return ComponentCriteria[] Returns an array of ComponentCriteria objects
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
    public function findOneBySomeField($value): ?ComponentCriteria
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
