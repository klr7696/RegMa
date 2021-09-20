<?php

namespace App\Repository\Nomenclatures;

use App\Entity\Nomenclatures\CompteFonction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteFonction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteFonction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteFonction[]    findAll()
 * @method CompteFonction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteFonctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteFonction::class);
    }

    // /**
    //  * @return CompteFonction[] Returns an array of CompteFonction objects
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
    public function findOneBySomeField($value): ?CompteFonction
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
