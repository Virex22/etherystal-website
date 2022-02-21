<?php

namespace App\Repository;

use App\Entity\Etherystal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etherystal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etherystal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etherystal[]    findAll()
 * @method Etherystal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtherystalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etherystal::class);
    }



    public function searchByValue(string $value,string $filter)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.'.$filter.' = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Etherystal
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}