<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\ExerciceRegistre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExerciceRegistre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceRegistre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceRegistre[]    findAll()
 * @method ExerciceRegistre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRegistreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceRegistre::class);
    }

    // /**
    //  * @return ExerciceRegistre[] Returns an array of ExerciceRegistre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExerciceRegistre
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
