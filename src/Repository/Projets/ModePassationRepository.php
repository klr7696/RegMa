<?php

namespace App\Repository\Projets;

use App\Entity\Projets\ModePassation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModePassation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModePassation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModePassation[]    findAll()
 * @method ModePassation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModePassationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModePassation::class);
    }

    // /**
    //  * @return ModePassation[] Returns an array of ModePassation objects
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
    public function findOneBySomeField($value): ?ModePassation
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
