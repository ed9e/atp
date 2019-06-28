<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613200304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE garmin_calendar_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE garmin_calendar (id INT NOT NULL, garmin_id INT NOT NULL, training_plan_id INT DEFAULT NULL, item_type VARCHAR(255) NOT NULL, activity_type_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, date VARCHAR(255) NOT NULL, duration BIGINT DEFAULT NULL, distance BIGINT DEFAULT NULL, calories INT DEFAULT NULL, weight INT DEFAULT NULL, course_id INT DEFAULT NULL, course_name VARCHAR(255) DEFAULT NULL, start_timestamp_local VARCHAR(255) DEFAULT NULL, elapsed_duration DOUBLE PRECISION DEFAULT NULL, lap_count INT DEFAULT NULL, workout_id INT DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE garmin_calendar_id_seq CASCADE');
        $this->addSql('DROP TABLE garmin_calendar');
    }
}
