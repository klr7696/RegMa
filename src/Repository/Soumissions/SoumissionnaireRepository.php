<?php

namespace App\Repository\Soumissions;

use App\Entity\Soumissions\Soumissionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soumissionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soumissionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soumissionnaire[]    findAll()
 * @method Soumissionnaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoumissionnaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soumissionnaire::class);
    }

    // /**
    //  * @return Soumissionnaire[] Returns an array of Soumissionnaire objects
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
    public function findOneBySomeField($value): ?Soumissionnaire
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
