<?php

namespace App\Repository\Plans;

use App\Entity\Plans\LienPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LienPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method LienPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method LienPlan[]    findAll()
 * @method LienPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LienPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LienPlan::class);
    }

    // /**
    //  * @return LienPlan[] Returns an array of LienPlan objects
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
    public function findOneBySomeField($value): ?LienPlan
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
