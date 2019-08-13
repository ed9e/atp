<?php

namespace App\Repository;

use App\Entity\OwnerFullName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OwnerFullName|null find($id, $lockMode = null, $lockVersion = null)
 * @method OwnerFullName|null findOneBy(array $criteria, array $orderBy = null)
 * @method OwnerFullName[]    findAll()
 * @method OwnerFullName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OwnerFullNameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OwnerFullName::class);
    }

    // /**
    //  * @return OwnerFullName[] Returns an array of OwnerFullName objects
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
    public function findOneBySomeField($value): ?OwnerFullName
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
