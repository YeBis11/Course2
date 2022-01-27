<?php

namespace App\Repository;

use App\Entity\StringField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StringField|null find($id, $lockMode = null, $lockVersion = null)
 * @method StringField|null findOneBy(array $criteria, array $orderBy = null)
 * @method StringField[]    findAll()
 * @method StringField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StringFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StringField::class);
    }

    // /**
    //  * @return StringField[] Returns an array of StringField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StringField
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
