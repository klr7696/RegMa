<?php

namespace App\Repository\Nomenclatures;

use App\Entity\Nomenclatures\CompteNature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteNature|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteNature|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteNature[]    findAll()
 * @method CompteNature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteNatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteNature::class);
    }

    // /**
    //  * @return CompteNature[] Returns an array of CompteNature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompteNature
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
