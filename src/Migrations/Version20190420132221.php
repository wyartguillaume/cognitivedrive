<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190420132221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient CHANGE date_de_naissance date_de_naissance DATE DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE profession profession VARCHAR(255) DEFAULT NULL, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT NULL, CHANGE nbr_enfants nbr_enfants INT DEFAULT NULL, CHANGE trouble_de_sommeil trouble_de_sommeil TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE psychologue ADD token VARCHAR(255) NOT NULL, ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE session CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient CHANGE date_de_naissance date_de_naissance DATE DEFAULT \'NULL\', CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE profession profession VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_enfants nbr_enfants INT DEFAULT NULL, CHANGE trouble_de_sommeil trouble_de_sommeil TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE psychologue DROP token, DROP is_active');
        $this->addSql('ALTER TABLE session CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL');
    }
}
