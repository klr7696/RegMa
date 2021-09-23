<?php

namespace App\Repository\Plans;

use App\Entity\Plans\PlanPassation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanPassation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanPassation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanPassation[]    findAll()
 * @method PlanPassation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanPassationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanPassation::class);
    }

    // /**
    //  * @return PlanPassation[] Returns an array of PlanPassation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlanPassation
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
