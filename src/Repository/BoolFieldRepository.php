<?php

namespace App\Repository;

use App\Entity\BoolField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BoolField|null find($id, $lockMode = null, $lockVersion = null)
 * @method BoolField|null findOneBy(array $criteria, array $orderBy = null)
 * @method BoolField[]    findAll()
 * @method BoolField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoolFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BoolField::class);
    }

    // /**
    //  * @return BoolField[] Returns an array of BoolField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BoolField
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
