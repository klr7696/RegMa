<?php

namespace App\Repository\Projets;

use App\Entity\Projets\DecisionMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DecisionMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method DecisionMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method DecisionMarche[]    findAll()
 * @method DecisionMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecisionMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DecisionMarche::class);
    }

    // /**
    //  * @return DecisionMarche[] Returns an array of DecisionMarche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DecisionMarche
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
