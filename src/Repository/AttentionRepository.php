<?php

namespace App\Repository;

use App\Entity\Attention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attention[]    findAll()
 * @method Attention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttentionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attention::class);
    }

    // /**
    //  * @return Attention[] Returns an array of Attention objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attention
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
