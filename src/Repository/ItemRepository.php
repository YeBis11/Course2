<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    // /**
    //  * @return Item[] Returns an array of Item objects
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

    public function findAllHydrated(): ?Array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT i, c, sf, tf, nf,  df, o, cc
            FROM App\Entity\Item i
            JOIN i.parent_collection c
            JOIN i.stringFields sf
            JOIN i.textFields tf
            JOIN i.numericFields nf
            JOIN i.dateFields df
            JOIN c.owner o
            JOIN c.Category cc
            order by i.createdAt'
        );
        return $query->getResult();
    }

    public function findAllHydratedQuery(): ?Query
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
            'SELECT i, c, sf, tf, nf,  df, o, cc
            FROM App\Entity\Item i
            JOIN i.parent_collection c
            JOIN i.stringFields sf
            JOIN i.textFields tf
            JOIN i.numericFields nf
            JOIN i.dateFields df
            JOIN c.owner o
            JOIN c.Category cc'
        );
    }

    /*
    public function findOneBySomeField($value): ?Item
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
