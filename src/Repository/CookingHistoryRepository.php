<?php

namespace App\Repository;

use App\Entity\CookingHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CookingHistory[]    findAll()
 * @method CookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CookingHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CookingHistory::class);
    }

    // /**
    //  * @return CookingHistory[] Returns an array of CookingHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CookingHistory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
