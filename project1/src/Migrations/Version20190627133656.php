<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190627133656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE garmin_activity_details ADD start_time_local TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD start_time_gmt TIME(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD start_latitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD start_longitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD distance DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD duration DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD moving_duration DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD elapsed_duration DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD elevation_gain DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD elevation_loss DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD max_elevation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD min_elevation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_speed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_moving_speed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD max_speed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD calories DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_hr DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD max_hr DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_run_cadence DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD max_run_cadence DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_temperature DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD max_temperature DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD min_temperature DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD ground_contact_time DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD ground_contact_balance_left DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD stride_length DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD vertical_oscillation DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD training_effect DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD vertical_ratio DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD lactate_threshold_speed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD end_latitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD end_longitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_id DROP DEFAULT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_uuid DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_name DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER user_profile_id DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER is_multi_sport_parent DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_type_id DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_type_key DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER is_original DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER user_display_name DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER elevation_corrected DROP NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity DROP insert_time');
        $this->addSql('ALTER TABLE garmin_activity DROP update_time');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE garmin_activity ADD insert_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'2019-06-27 13:17:52.63533\' NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity ADD update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details DROP start_time_local');
        $this->addSql('ALTER TABLE garmin_activity_details DROP start_time_gmt');
        $this->addSql('ALTER TABLE garmin_activity_details DROP start_latitude');
        $this->addSql('ALTER TABLE garmin_activity_details DROP start_longitude');
        $this->addSql('ALTER TABLE garmin_activity_details DROP distance');
        $this->addSql('ALTER TABLE garmin_activity_details DROP duration');
        $this->addSql('ALTER TABLE garmin_activity_details DROP moving_duration');
        $this->addSql('ALTER TABLE garmin_activity_details DROP elapsed_duration');
        $this->addSql('ALTER TABLE garmin_activity_details DROP elevation_gain');
        $this->addSql('ALTER TABLE garmin_activity_details DROP elevation_loss');
        $this->addSql('ALTER TABLE garmin_activity_details DROP max_elevation');
        $this->addSql('ALTER TABLE garmin_activity_details DROP min_elevation');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_speed');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_moving_speed');
        $this->addSql('ALTER TABLE garmin_activity_details DROP max_speed');
        $this->addSql('ALTER TABLE garmin_activity_details DROP calories');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_hr');
        $this->addSql('ALTER TABLE garmin_activity_details DROP max_hr');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_run_cadence');
        $this->addSql('ALTER TABLE garmin_activity_details DROP max_run_cadence');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_temperature');
        $this->addSql('ALTER TABLE garmin_activity_details DROP max_temperature');
        $this->addSql('ALTER TABLE garmin_activity_details DROP min_temperature');
        $this->addSql('ALTER TABLE garmin_activity_details DROP ground_contact_time');
        $this->addSql('ALTER TABLE garmin_activity_details DROP ground_contact_balance_left');
        $this->addSql('ALTER TABLE garmin_activity_details DROP stride_length');
        $this->addSql('ALTER TABLE garmin_activity_details DROP vertical_oscillation');
        $this->addSql('ALTER TABLE garmin_activity_details DROP training_effect');
        $this->addSql('ALTER TABLE garmin_activity_details DROP vertical_ratio');
        $this->addSql('ALTER TABLE garmin_activity_details DROP lactate_threshold_speed');
        $this->addSql('ALTER TABLE garmin_activity_details DROP end_latitude');
        $this->addSql('ALTER TABLE garmin_activity_details DROP end_longitude');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_id TYPE BIGINT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_id DROP DEFAULT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_uuid SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_name SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER user_profile_id SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER is_multi_sport_parent SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_type_id SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER activity_type_key SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER is_original SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER user_display_name SET NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER elevation_corrected SET NOT NULL');
    }
}
