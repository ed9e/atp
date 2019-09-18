<?php

namespace App\Repository;

use App\Entity\WeeklyActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WeeklyActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeeklyActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeeklyActivity[]    findAll()
 * @method WeeklyActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeeklyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WeeklyActivity::class);
    }

    public function findByOwnerFullName($value)
    {
        return $this->createQueryBuilder('w')
            ->where("IS_CONTAINED_BY(6,'w.activityTypeIdAgg')")
            ->andWhere('w.ownerFullName = :val')
            ->setParameter('val', $value)
            ->orderBy('w.weekly', 'DESC')
            ->setMaxResults(500)
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    // /**
    //  * @return Weekly[] Returns an array of Weekly objects
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
    public function findOneBySomeField($value): ?Weekly
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
