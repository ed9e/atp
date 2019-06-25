<?php

namespace App\Repository;

use App\Entity\GarminActivityDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GarminActivityDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method GarminActivityDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method GarminActivityDetails[]    findAll()
 * @method GarminActivityDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityDetailsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GarminActivityDetails::class);
    }

    // /**
    //  * @return ActivityDetails[] Returns an array of ActivityDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActivityDetails
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
