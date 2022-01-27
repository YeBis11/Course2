<?php

namespace App\Repository;

use App\Entity\TextField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TextField|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextField|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextField[]    findAll()
 * @method TextField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextField::class);
    }

    // /**
    //  * @return TextField[] Returns an array of TextField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TextField
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
