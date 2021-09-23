<?php

namespace App\Repository\Commissions;

use App\Entity\Commissions\ParticipantCommission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParticipantCommission|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipantCommission|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipantCommission[]    findAll()
 * @method ParticipantCommission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantCommissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipantCommission::class);
    }

    // /**
    //  * @return ParticipantCommission[] Returns an array of ParticipantCommission objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParticipantCommission
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
