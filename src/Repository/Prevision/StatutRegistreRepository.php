<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\StatutRegistre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatutRegistre|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatutRegistre|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatutRegistre[]    findAll()
 * @method StatutRegistre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatutRegistreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatutRegistre::class);
    }

    // /**
    //  * @return StatutRegistre[] Returns an array of StatutRegistre objects
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
    public function findOneBySomeField($value): ?StatutRegistre
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
