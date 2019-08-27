<?php

namespace App\Repository;

use App\Entity\GarminActivityDetails;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Exception;
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

    /**
     * @param $value
     * @return GarminActivityDetails[] Returns an array of ActivityDetails objects
     * @throws Exception
     */
    public function findByStartTime($value)
    {
        $dateFrom = (new DateTime())->setTimestamp(strtotime($value));
        if ($dateFrom->format('w') !== '1') {//jeśli nie pierwszy dzień tyg
            $dateFrom = (new DateTime())->setTimestamp(strtotime('previous monday', strtotime($value)));
        }
        $dateTo = (new DateTime())->setTimestamp(strtotime('next monday', strtotime($value)));

        $who = 'lbrzozowski';
        $activityType = [1, 6];

        return $this->createQueryBuilder('a')
            ->andWhere('a.startTimeLocal >= :from')
            ->setParameter('from', $dateFrom)
            ->andWhere('a.startTimeLocal <= :to')
            ->setParameter('to', $dateTo)
            ->andWhere('a.userDisplayName = :who')
            ->setParameter('who', $who)
            ->andWhere('a.activityTypeId IN (:type)')
            ->setParameter('type', $activityType, Connection::PARAM_STR_ARRAY)
            ->orderBy('a.activityId', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();
    }


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
