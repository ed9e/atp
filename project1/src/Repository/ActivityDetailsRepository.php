<?php

namespace App\Repository;

use App\Entity\GarminActivityDetails;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GarminActivityDetails::class);
    }

    /**
     * @param $value
     * @return GarminActivityDetails[] Returns an array of ActivityDetails objects
     * @throws Exception
     */
    public function findByStartTime($queryRequest)
    {
        $dateFrom = (new DateTime())->setTimestamp(strtotime($queryRequest['data']));
        if ($dateFrom->format('w') !== '1') {//jeśli nie pierwszy dzień tyg
            $dateFrom = (new DateTime())->setTimestamp(strtotime('previous monday', strtotime($queryRequest['data'])));
        }
        $dateTo = (new DateTime())->setTimestamp(strtotime('next monday', strtotime($queryRequest['data'])));

        $activityType = array_filter($queryRequest['activityId']);

        $who = $queryRequest['userDisplayName'];
        //$activityType = [1, 6];

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
