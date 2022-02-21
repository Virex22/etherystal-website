<?php

namespace App\Repository;

use App\Entity\Rarety;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rarety|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rarety|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rarety[]    findAll()
 * @method Rarety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaretyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rarety::class);
    }

    // /**
    //  * @return Rarety[] Returns an array of Rarety objects
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
    public function findOneBySomeField($value): ?Rarety
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
