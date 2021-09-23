<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\BailleurFonds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BailleurFonds|null find($id, $lockMode = null, $lockVersion = null)
 * @method BailleurFonds|null findOneBy(array $criteria, array $orderBy = null)
 * @method BailleurFonds[]    findAll()
 * @method BailleurFonds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BailleurFondsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BailleurFonds::class);
    }

    // /**
    //  * @return BailleurFonds[] Returns an array of BailleurFonds objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BailleurFonds
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
