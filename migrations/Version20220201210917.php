<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201210917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etherystal ADD material_id INT DEFAULT NULL, ADD color_id INT DEFAULT NULL, ADD rarety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etherystal ADD CONSTRAINT FK_3337BC8E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE etherystal ADD CONSTRAINT FK_3337BC87ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('ALTER TABLE etherystal ADD CONSTRAINT FK_3337BC884B6B508 FOREIGN KEY (rarety_id) REFERENCES rarety (id)');
        $this->addSql('CREATE INDEX IDX_3337BC8E308AC6F ON etherystal (material_id)');
        $this->addSql('CREATE INDEX IDX_3337BC87ADA1FB5 ON etherystal (color_id)');
        $this->addSql('CREATE INDEX IDX_3337BC884B6B508 ON etherystal (rarety_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE color CHANGE color_preview color_preview VARCHAR(10) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE etherystal DROP FOREIGN KEY FK_3337BC8E308AC6F');
        $this->addSql('ALTER TABLE etherystal DROP FOREIGN KEY FK_3337BC87ADA1FB5');
        $this->addSql('ALTER TABLE etherystal DROP FOREIGN KEY FK_3337BC884B6B508');
        $this->addSql('DROP INDEX IDX_3337BC8E308AC6F ON etherystal');
        $this->addSql('DROP INDEX IDX_3337BC87ADA1FB5 ON etherystal');
        $this->addSql('DROP INDEX IDX_3337BC884B6B508 ON etherystal');
        $this->addSql('ALTER TABLE etherystal DROP material_id, DROP color_id, DROP rarety_id, CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE material_instance_name material_instance_name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE property property LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE material CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE rarety CHANGE name name VARCHAR(25) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
