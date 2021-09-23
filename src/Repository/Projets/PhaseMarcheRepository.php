<?php

namespace App\Repository\Projets;

use App\Entity\Projets\PhaseMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhaseMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhaseMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhaseMarche[]    findAll()
 * @method PhaseMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhaseMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhaseMarche::class);
    }

    // /**
    //  * @return PhaseMarche[] Returns an array of PhaseMarche objects
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
    public function findOneBySomeField($value): ?PhaseMarche
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
