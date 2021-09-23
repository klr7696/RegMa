<?php

namespace App\Repository\Administration;

use App\Entity\Administration\MairieCommunale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MairieCommunale|null find($id, $lockMode = null, $lockVersion = null)
 * @method MairieCommunale|null findOneBy(array $criteria, array $orderBy = null)
 * @method MairieCommunale[]    findAll()
 * @method MairieCommunale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MairieCommunaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MairieCommunale::class);
    }

    // /**
    //  * @return MairieCommunale[] Returns an array of MairieCommunale objects
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
    public function findOneBySomeField($value): ?MairieCommunale
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
