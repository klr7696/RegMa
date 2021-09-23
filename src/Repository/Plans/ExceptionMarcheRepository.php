<?php

namespace App\Repository\Plans;

use App\Entity\Plans\ExceptionMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExceptionMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExceptionMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExceptionMarche[]    findAll()
 * @method ExceptionMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExceptionMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExceptionMarche::class);
    }

    // /**
    //  * @return ExceptionMarche[] Returns an array of ExceptionMarche objects
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
    public function findOneBySomeField($value): ?ExceptionMarche
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
