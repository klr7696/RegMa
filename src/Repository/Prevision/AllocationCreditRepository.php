<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\AllocationCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AllocationCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllocationCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllocationCredit[]    findAll()
 * @method AllocationCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllocationCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AllocationCredit::class);
    }

    // /**
    //  * @return AllocationCredit[] Returns an array of AllocationCredit objects
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
    public function findOneBySomeField($value): ?AllocationCredit
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
