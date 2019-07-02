<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628061655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE garmin_activity_details ADD activity_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details ADD start_time_gmt TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details DROP id');
        $this->addSql('ALTER TABLE garmin_activity_details ADD PRIMARY KEY (activity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX garmin_activity_details_pkey');
        $this->addSql('ALTER TABLE garmin_activity_details ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE garmin_activity_details DROP activity_id');
        $this->addSql('ALTER TABLE garmin_activity_details DROP start_time_gmt');
        $this->addSql('ALTER TABLE garmin_activity_details ADD PRIMARY KEY (id)');
    }
}
