<?php

namespace App\Repository\Prevision;

use App\Entity\Prevision\RessourceFinanciere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RessourceFinanciere|null find($id, $lockMode = null, $lockVersion = null)
 * @method RessourceFinanciere|null findOneBy(array $criteria, array $orderBy = null)
 * @method RessourceFinanciere[]    findAll()
 * @method RessourceFinanciere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessourceFinanciereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RessourceFinanciere::class);
    }

    // /**
    //  * @return RessourceFinanciere[] Returns an array of RessourceFinanciere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RessourceFinanciere
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
