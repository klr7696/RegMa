<?php

namespace App\Repository\Plans;

use App\Entity\Plans\StatutPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatutPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutPlan[]    findAll()
 * @method StatutPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutPlan::class);
    }

    // /**
    //  * @return StatutPlan[] Returns an array of StatutPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatutPlan
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
