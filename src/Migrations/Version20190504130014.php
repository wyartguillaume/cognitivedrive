<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190504130014 extends AbstractMigration
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
        $this->addSql('ALTER TABLE session ADD nbr_rencontre_route_droite INT DEFAULT NULL, ADD nbr_rencontre_route_gauche INT DEFAULT NULL, ADD vitesse_moyenne_zone_obstacle DOUBLE PRECISION DEFAULT NULL, ADD temps_de_reaction DOUBLE PRECISION DEFAULT NULL, ADD nbr_touche_pietons_droit INT DEFAULT NULL, ADD nbr_touche_pietons_gauche INT DEFAULT NULL, ADD nbr_animal_touche_gauche INT DEFAULT NULL, ADD nbr_animal_touche_droite INT DEFAULT NULL, ADD nbr_total_obstacle_touche_droit INT DEFAULT NULL, ADD nbr_total_obstacle_touche_gauche INT DEFAULT NULL, ADD level VARCHAR(255) DEFAULT NULL, ADD choix_jour_nuit VARCHAR(255) DEFAULT NULL, ADD nbr_sortie_timer_gauche VARCHAR(255) DEFAULT NULL, ADD nbr_sortie_timer_droite VARCHAR(255) DEFAULT NULL, ADD nbr_voiture_trop_proche INT DEFAULT NULL, ADD date_session VARCHAR(255) DEFAULT NULL, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient CHANGE date_de_naissance date_de_naissance DATE DEFAULT \'NULL\', CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE profession profession VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_enfants nbr_enfants INT DEFAULT NULL, CHANGE trouble_de_sommeil trouble_de_sommeil TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE session DROP nbr_rencontre_route_droite, DROP nbr_rencontre_route_gauche, DROP vitesse_moyenne_zone_obstacle, DROP temps_de_reaction, DROP nbr_touche_pietons_droit, DROP nbr_touche_pietons_gauche, DROP nbr_animal_touche_gauche, DROP nbr_animal_touche_droite, DROP nbr_total_obstacle_touche_droit, DROP nbr_total_obstacle_touche_gauche, DROP level, DROP choix_jour_nuit, DROP nbr_sortie_timer_gauche, DROP nbr_sortie_timer_droite, DROP nbr_voiture_trop_proche, DROP date_session, CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL');
    }
}
