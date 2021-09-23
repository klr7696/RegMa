<?php

namespace App\Repository\Soumissions;

use App\Entity\Soumissions\SoumissionMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SoumissionMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoumissionMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoumissionMarche[]    findAll()
 * @method SoumissionMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoumissionMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoumissionMarche::class);
    }

    // /**
    //  * @return SoumissionMarche[] Returns an array of SoumissionMarche objects
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
    public function findOneBySomeField($value): ?SoumissionMarche
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
