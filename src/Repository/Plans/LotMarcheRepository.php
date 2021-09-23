<?php

namespace App\Repository\Plans;

use App\Entity\Plans\LotMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LotMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method LotMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method LotMarche[]    findAll()
 * @method LotMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LotMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LotMarche::class);
    }

    // /**
    //  * @return LotMarche[] Returns an array of LotMarche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LotMarche
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
