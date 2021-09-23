<?php

namespace App\Repository\Operations;

use App\Entity\Operations\Mandatement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mandatement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mandatement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mandatement[]    findAll()
 * @method Mandatement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MandatementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mandatement::class);
    }

    // /**
    //  * @return Mandatement[] Returns an array of Mandatement objects
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
    public function findOneBySomeField($value): ?Mandatement
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
