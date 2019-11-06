<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105141020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE "app_user" (id INT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D17F50A6 ON "app_user" (uuid)');
        $this->addSql('CREATE TABLE weekly_activity (weekly VARCHAR(255) NOT NULL, time_minute_sum INT NOT NULL, distance_sum INT NOT NULL, owner_full_name VARCHAR(255) NOT NULL, activity_type_id_agg integer[] NOT NULL, PRIMARY KEY(weekly))');
        $this->addSql('COMMENT ON COLUMN weekly_activity.activity_type_id_agg IS \'(DC2Type:integer[])\'');
        $this->addSql('ALTER TABLE atp ALTER "values" TYPE TEXT');
        $this->addSql('ALTER TABLE atp ALTER "values" DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE "app_user"');
        $this->addSql('DROP TABLE weekly_activity');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER comments TYPE TEXT');
        $this->addSql('ALTER TABLE garmin_activity_details ALTER comments DROP DEFAULT');
        $this->addSql('ALTER TABLE atp ALTER values TYPE TEXT');
        $this->addSql('ALTER TABLE atp ALTER values DROP DEFAULT');
        $this->addSql('ALTER TABLE atp ALTER values TYPE TEXT');
    }
}
