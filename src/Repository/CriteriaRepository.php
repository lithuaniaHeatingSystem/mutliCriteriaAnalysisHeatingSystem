<?php

namespace App\Repository;

use App\Entity\Criteria;
use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Criteria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Criteria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Criteria[]    findAll()
 * @method Criteria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CriteriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Criteria::class);
    }

    /**
     * Find all criteria by type
     *
     * @param Type $type
     *
     * @return mixed
     */
    public function findByType(Type $type)
    {
        return $this->createQueryBuilder('c')->join('c.criteriaTypes', 'criteria_types', 'WITH',
            'criteria_types.type = :type')
            ->setParameter('type', $type)
            ->getQuery()->getResult();
    }
}
