<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304215309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, psychologue_id INT NOT NULL, pseudo VARCHAR(255) NOT NULL, date_de_naissance DATE DEFAULT NULL, sexe TINYINT(1) NOT NULL, lateralite VARCHAR(255) NOT NULL, groupe VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, etat_civil VARCHAR(255) DEFAULT NULL, nbr_enfants INT DEFAULT NULL, nbr_visite INT NOT NULL, date_derniere_visite DATE NOT NULL, trouble_de_sommeil TINYINT(1) DEFAULT NULL, INDEX IDX_1ADAD7EB465459D3 (psychologue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB465459D3 FOREIGN KEY (psychologue_id) REFERENCES psychologue (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE patient');
    }
}
