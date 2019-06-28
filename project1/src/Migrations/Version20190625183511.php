<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625183511 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE activity_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE activity_details (id INT NOT NULL, activity_id BIGINT NOT NULL, activity_uuid VARCHAR(255) NOT NULL, activity_name VARCHAR(255) NOT NULL, user_profile_id BIGINT NOT NULL, is_multi_sport_parent BOOLEAN NOT NULL, activity_type_id INT NOT NULL, activity_type_key VARCHAR(255) NOT NULL, is_original BOOLEAN NOT NULL, user_display_name VARCHAR(255) NOT NULL, associated_workout_id BIGINT NOT NULL, elevation_corrected BOOLEAN NOT NULL, PRIMARY KEY(id))');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE activity_details_id_seq CASCADE');
        $this->addSql('DROP TABLE activity_details');
        $this->addSql('ALTER TABLE garmin_calendar ADD insert_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL');
        $this->addSql('ALTER TABLE garmin_calendar ADD update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity ADD insert_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'2019-06-14 17:08:27.371367\' NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity ADD update_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }
}
