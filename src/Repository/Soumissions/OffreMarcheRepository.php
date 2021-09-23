<?php

namespace App\Repository\Soumissions;

use App\Entity\Soumissions\OffreMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OffreMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreMarche[]    findAll()
 * @method OffreMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreMarche::class);
    }

    // /**
    //  * @return OffreMarche[] Returns an array of OffreMarche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreMarche
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
