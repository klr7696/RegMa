<?php

namespace App\Repository\Projets;

use App\Entity\Projets\ProjetMarche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjetMarche|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetMarche|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetMarche[]    findAll()
 * @method ProjetMarche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetMarcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetMarche::class);
    }

    // /**
    //  * @return ProjetMarche[] Returns an array of ProjetMarche objects
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
    public function findOneBySomeField($value): ?ProjetMarche
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
