<?php

namespace App\Repository\Contrats;

use App\Entity\Contrats\ItemCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCommande[]    findAll()
 * @method ItemCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCommande::class);
    }

    // /**
    //  * @return ItemCommande[] Returns an array of ItemCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemCommande
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
