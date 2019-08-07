<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709134738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('CREATE OR REPLACE  VIEW public.weekly_activity AS  
  SELECT (round(avg(foo.vertical_oscillation)::numeric, 2) || \' \'::text) || array_agg(round(foo.vertical_oscillation::numeric, 2))::text AS vert_osc, 
     round(avg(foo.max_temperature)) AS max_temp, 
     round(avg(foo.min_temperature)) AS min_temp, 
     round(avg(foo.training_effect)::numeric, 2) AS training_effect, 
     round((sum(foo.distance) / 1000::double precision)::numeric, 3) AS distance_sum, 
     to_char((sum(foo.duration) || \' second\'::text)::interval, \'HH24:MI:SS\'::text) AS time_sum, 
     round((sum(foo.duration)/60)::numeric, 0) AS time_minute_sum, 
     array_agg((round((foo.distance / 1000::double precision)::numeric, 3)::text || \'km \'::text) || to_char(foo.start_time_local, \'Day\'::text)) AS array_agg, 
     date_trunc(\'week\'::text, foo.start_time_local + \'00:00:00\'::interval)::date AS weekly, 
     foo.user_display_name 
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
   WHERE foo.activity_type_id = ANY (ARRAY[1, 6]) 
   GROUP BY foo.user_display_name, date_trunc(\'week\'::text, foo.start_time_local + \'00:00:00\'::interval)::date 
   ORDER BY date_trunc(\'week\'::text, foo.start_time_local + \'00:00:00\'::interval)::date DESC;');




    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
