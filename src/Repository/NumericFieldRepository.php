<?php

namespace App\Repository;

use App\Entity\NumericField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NumericField|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumericField|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumericField[]    findAll()
 * @method NumericField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumericFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumericField::class);
    }

    // /**
    //  * @return NumericField[] Returns an array of NumericField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NumericField
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
