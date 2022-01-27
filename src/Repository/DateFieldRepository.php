<?php

namespace App\Repository;

use App\Entity\DateField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateField|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateField|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateField[]    findAll()
 * @method DateField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateField::class);
    }

    // /**
    //  * @return DateField[] Returns an array of DateField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateField
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
