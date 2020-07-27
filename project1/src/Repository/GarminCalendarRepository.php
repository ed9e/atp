<?php

namespace App\Repository;

use App\Entity\GarminActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GarminActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method GarminActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method GarminActivity[]    findAll()
 * @method GarminActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GarminCalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GarminActivity::class);
    }

    // /**
    //  * @return GarminCalendar[] Returns an array of GarminCalendar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GarminCalendar
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
