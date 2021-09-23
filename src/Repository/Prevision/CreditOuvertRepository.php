<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\CreditOuvert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CreditOuvert|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditOuvert|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditOuvert[]    findAll()
 * @method CreditOuvert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditOuvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditOuvert::class);
    }

    // /**
    //  * @return CreditOuvert[] Returns an array of CreditOuvert objects
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
    public function findOneBySomeField($value): ?CreditOuvert
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
