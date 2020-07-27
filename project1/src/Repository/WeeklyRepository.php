<?php

namespace App\Repository;

use App\Entity\GarminActivityDetails;
use App\Entity\WeeklyActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WeeklyActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeeklyActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeeklyActivity[]    findAll()
 * @method WeeklyActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeeklyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        //parent::__construct($registry, WeeklyActivity::class);
        parent::__construct($registry, GarminActivityDetails::class);
    }

    public function findByOwnerFullName($queryData)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.ownerFullName = :val')
            ->setParameter('val', $queryData['ownerFullName'])
            ->orderBy('w.weekly', 'DESC')
            ->setMaxResults(500)
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    public function getWeekly2($queryData)
    {
        $qb = $this->createQueryBuilder('w')
            ->select('WEEKLY(w.startTimeLocal) AS weekly')
            ->addSelect('SUM(w.distance)/1000 AS distanceSum')
            ->addSelect('TIME_MINUTE_SUM(w.duration) AS timeMinuteSum')
            ->addSelect('ARRAY_AGG(w.activityTypeId) AS activityTypeIdAgg')
            ->groupBy('weekly')
            ->orderBy('weekly', 'DESC')
            ->setMaxResults(1000);
        $qb->andWhere('w.userDisplayName = :userDisplayName')
            ->setParameter('userDisplayName', $queryData['userDisplayName']);

        $wheres = [];
        foreach ($queryData['activityId'] as $key => $val) {
            $wheres[] = $qb->expr()->eq('w.activityTypeId', ':activityId' . $key);
        }

        $qb->andWhere($qb->expr()->orX()->addMultiple($wheres));

        foreach ($queryData['activityId'] as $key => $val) {
            $qb->setParameter('activityId' . $key, $val);
        }

        return $qb->getQuery()
            ->getResult(AbstractQuery::HYDRATE_ARRAY);
    }

    public function getWeekly($data)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "
SELECT (round(avg(foo.vertical_oscillation)::numeric, 2) || ' '::text) || array_agg(round(foo.vertical_oscillation::numeric, 2))::text AS vert_osc, 
     round(avg(foo.training_effect)::numeric, 2) AS training_effect, 
     round((sum(foo.distance) / 1000::double precision)::numeric, 3) AS distance_sum, 
     to_char((sum(foo.duration) || ' second'::text)::interval, 'HH24:MI:SS'::text) AS time_sum, 
     round((sum(foo.duration) / 60::double precision)::numeric, 0) AS time_minute_sum, 
     array_agg((round((foo.distance / 1000::double precision)::numeric, 3)::text || 'km '::text) || to_char(foo.start_time_local, 'Day'::text)) AS array_agg, 
     date_trunc('week'::text, foo.start_time_local + '00:00:00'::interval)::date AS weekly, 
     array_agg(foo.v_o2max_value) AS v_o2, 
     foo.user_display_name, 
     foo.owner_full_name, 
     array_agg(foo.activity_type_id) AS activity_type_id_agg
    FROM ( SELECT garmin_activity_details.activity_uuid, 
             garmin_activity_details.activity_name, 
             garmin_activity_details.user_profile_id, 
             garmin_activity_details.is_multi_sport_parent, 
             garmin_activity_details.activity_type_id, 
             garmin_activity_details.activity_type_key, 
             garmin_activity_details.is_original, 
             garmin_activity_details.user_display_name, 
             garmin_activity_details.associated_workout_id, 
             garmin_activity_details.elevation_corrected, 
             garmin_activity_details.start_latitude, 
             garmin_activity_details.start_longitude, 
             garmin_activity_details.distance, 
             garmin_activity_details.duration, 
             garmin_activity_details.moving_duration, 
             garmin_activity_details.elapsed_duration, 
             garmin_activity_details.elevation_gain, 
             garmin_activity_details.elevation_loss, 
             garmin_activity_details.max_elevation, 
             garmin_activity_details.min_elevation, 
             garmin_activity_details.average_speed, 
             garmin_activity_details.average_moving_speed, 
             garmin_activity_details.max_speed, 
             garmin_activity_details.calories, 
             garmin_activity_details.average_hr, 
             garmin_activity_details.max_hr, 
             garmin_activity_details.average_run_cadence, 
             garmin_activity_details.max_run_cadence, 
             garmin_activity_details.average_temperature, 
             garmin_activity_details.max_temperature, 
             garmin_activity_details.min_temperature, 
             garmin_activity_details.ground_contact_time, 
             garmin_activity_details.ground_contact_balance_left, 
             garmin_activity_details.stride_length, 
             garmin_activity_details.vertical_oscillation, 
             garmin_activity_details.training_effect, 
             garmin_activity_details.vertical_ratio, 
             garmin_activity_details.lactate_threshold_speed, 
             garmin_activity_details.end_latitude, 
             garmin_activity_details.end_longitude, 
             garmin_activity_details.start_time_local, 
             garmin_activity_details.activity_id, 
             garmin_activity_details.start_time_gmt, 
             garmin_activity_details.description, 
             garmin_activity_details.activity_parent_type_id, 
             garmin_activity_details.comments, 
             garmin_activity_details.owner_full_name, 
             garmin_activity_details.average_swolf, 
             garmin_activity_details.steps, 
             garmin_activity_details.number_of_activity_likes, 
             garmin_activity_details.training_effect_anaerobic, 
             garmin_activity_details.v_o2max_value, 
             garmin_activity_details.avg_ground_contact_balance, 
             garmin_activity_details.lactate_threshold_bpm, 
             garmin_activity_details.device_id 
            FROM garmin_activity_details 
           ORDER BY garmin_activity_details.start_time_local DESC) foo 
    WHERE foo.activity_type_id = any (ARRAY[(:activity_type_id)])
   GROUP BY foo.user_display_name, foo.owner_full_name, date_trunc('week'::text, foo.start_time_local + '00:00:00'::interval)::date 
   ORDER BY date_trunc('week'::text, foo.start_time_local + '00:00:00'::interval)::date DESC
            ";
        $stmt = $conn->prepare($sql);
        $datas = [
            'activity_type_id' => 1,

        ];
        $stmt->bindValue('activity_type_id', [1, 2, 6]);

        $stmt->execute();
        return $stmt->fetchAll();
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
