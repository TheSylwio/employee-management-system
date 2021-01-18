<?php

namespace App\Repository;

use App\Entity\Overtime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Overtime|null find($id, $lockMode = null, $lockVersion = null)
 * @method Overtime|null findOneBy(array $criteria, array $orderBy = null)
 * @method Overtime[]    findAll()
 * @method Overtime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OvertimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Overtime::class);
    }

    // /**
    //  * @return Overtime[] Returns an array of Overtime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Overtime
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
