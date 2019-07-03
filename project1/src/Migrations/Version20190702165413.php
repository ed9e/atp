<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190702165413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE garmin_activity_details ADD description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD activity_parent_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD comments VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD owner_full_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD average_swolf DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD steps INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD number_of_activity_likes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD training_effect_anaerobic DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD v_o2max_value DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD avg_ground_contact_balance DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD lactate_threshold_bpm DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD device_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE garmin_activity_details DROP description');
        $this->addSql('ALTER TABLE garmin_activity_details DROP activity_parent_type_id');
        $this->addSql('ALTER TABLE garmin_activity_details DROP comments');
        $this->addSql('ALTER TABLE garmin_activity_details DROP owner_full_name');
        $this->addSql('ALTER TABLE garmin_activity_details DROP average_swolf');
        $this->addSql('ALTER TABLE garmin_activity_details DROP steps');
        $this->addSql('ALTER TABLE garmin_activity_details DROP number_of_activity_likes');
        $this->addSql('ALTER TABLE garmin_activity_details DROP training_effect_anaerobic');
        $this->addSql('ALTER TABLE garmin_activity_details DROP v_o2max_value');
        $this->addSql('ALTER TABLE garmin_activity_details DROP avg_ground_contact_balance');
        $this->addSql('ALTER TABLE garmin_activity_details DROP lactate_threshold_bpm');
        $this->addSql('ALTER TABLE garmin_activity_details DROP device_id');
    }
}
