<?php

namespace App\Repository;

use App\Entity\WallpagePosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WallpagePosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method WallpagePosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method WallpagePosts[]    findAll()
 * @method WallpagePosts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WallpagePostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WallpagePosts::class);
    }

    // /**
    //  * @return WallpagePosts[] Returns an array of WallpagePosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WallpagePosts
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
