<?php

namespace App\Repository\Commissions;

use App\Entity\Commissions\MembreCommission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MembreCommission|null find($id, $lockMode = null, $lockVersion = null)
 * @method MembreCommission|null findOneBy(array $criteria, array $orderBy = null)
 * @method MembreCommission[]    findAll()
 * @method MembreCommission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreCommissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MembreCommission::class);
    }

    // /**
    //  * @return MembreCommission[] Returns an array of MembreCommission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MembreCommission
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
