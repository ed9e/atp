<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627212414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE garmin_calendar (id INT NOT NULL, garmin_id INT NOT NULL, training_plan_id INT DEFAULT NULL, item_type VARCHAR(255) NOT NULL, activity_type_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, date VARCHAR(255) NOT NULL, duration BIGINT DEFAULT NULL, distance BIGINT DEFAULT NULL, calories INT DEFAULT NULL, weight INT DEFAULT NULL, course_id INT DEFAULT NULL, course_name VARCHAR(255) DEFAULT NULL, start_timestamp_local VARCHAR(255) DEFAULT NULL, elapsed_duration DOUBLE PRECISION DEFAULT NULL, lap_count INT DEFAULT NULL, workout_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE garmin_activity_details (activity_id BIGINT NOT NULL, activity_uuid VARCHAR(255) DEFAULT NULL, activity_name VARCHAR(255) DEFAULT NULL, user_profile_id BIGINT DEFAULT NULL, is_multi_sport_parent BOOLEAN DEFAULT NULL, activity_type_id INT DEFAULT NULL, activity_type_key VARCHAR(255) DEFAULT NULL, is_original BOOLEAN DEFAULT NULL, user_display_name VARCHAR(255) DEFAULT NULL, associated_workout_id BIGINT DEFAULT NULL, elevation_corrected BOOLEAN DEFAULT NULL, start_latitude DOUBLE PRECISION DEFAULT NULL, start_longitude DOUBLE PRECISION DEFAULT NULL, distance DOUBLE PRECISION DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, moving_duration DOUBLE PRECISION DEFAULT NULL, elapsed_duration DOUBLE PRECISION DEFAULT NULL, elevation_gain DOUBLE PRECISION DEFAULT NULL, elevation_loss DOUBLE PRECISION DEFAULT NULL, max_elevation DOUBLE PRECISION DEFAULT NULL, min_elevation DOUBLE PRECISION DEFAULT NULL, average_speed DOUBLE PRECISION DEFAULT NULL, average_moving_speed DOUBLE PRECISION DEFAULT NULL, max_speed DOUBLE PRECISION DEFAULT NULL, calories DOUBLE PRECISION DEFAULT NULL, average_hr DOUBLE PRECISION DEFAULT NULL, max_hr DOUBLE PRECISION DEFAULT NULL, average_run_cadence DOUBLE PRECISION DEFAULT NULL, max_run_cadence DOUBLE PRECISION DEFAULT NULL, average_temperature DOUBLE PRECISION DEFAULT NULL, max_temperature DOUBLE PRECISION DEFAULT NULL, min_temperature DOUBLE PRECISION DEFAULT NULL, ground_contact_time DOUBLE PRECISION DEFAULT NULL, ground_contact_balance_left DOUBLE PRECISION DEFAULT NULL, stride_length DOUBLE PRECISION DEFAULT NULL, vertical_oscillation DOUBLE PRECISION DEFAULT NULL, training_effect DOUBLE PRECISION DEFAULT NULL, lactate_threshold_speed DOUBLE PRECISION DEFAULT NULL, end_latitude DOUBLE PRECISION DEFAULT NULL, end_longitude DOUBLE PRECISION DEFAULT NULL, vertical_ratio DOUBLE PRECISION DEFAULT NULL, start_time_local TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, start_time_gmt TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(activity_id))');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE garmin_activity (garmin_id BIGINT NOT NULL, training_plan_id BIGINT DEFAULT NULL, item_type VARCHAR(255) NOT NULL, activity_type_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, date VARCHAR(255) NOT NULL, duration BIGINT DEFAULT NULL, distance BIGINT DEFAULT NULL, calories INT DEFAULT NULL, weight INT DEFAULT NULL, course_id INT DEFAULT NULL, course_name VARCHAR(255) DEFAULT NULL, start_timestamp_local VARCHAR(255) DEFAULT NULL, elapsed_duration DOUBLE PRECISION DEFAULT NULL, lap_count INT DEFAULT NULL, workout_id INT DEFAULT NULL, PRIMARY KEY(garmin_id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE garmin_calendar');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE garmin_activity_details');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE garmin_activity');
    }
}
