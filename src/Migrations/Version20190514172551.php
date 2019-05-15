<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514172551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire ADD sujet VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE date_de_naissance date_de_naissance DATE DEFAULT NULL, CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE profession profession VARCHAR(255) DEFAULT NULL, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT NULL, CHANGE nbr_enfants nbr_enfants INT DEFAULT NULL, CHANGE trouble_de_sommeil trouble_de_sommeil TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE session CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT NULL, CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL, CHANGE nbr_rencontre_route_droite nbr_rencontre_route_droite INT DEFAULT NULL, CHANGE nbr_rencontre_route_gauche nbr_rencontre_route_gauche INT DEFAULT NULL, CHANGE vitesse_moyenne_zone_obstacle vitesse_moyenne_zone_obstacle DOUBLE PRECISION DEFAULT NULL, CHANGE temps_de_reaction temps_de_reaction DOUBLE PRECISION DEFAULT NULL, CHANGE nbr_touche_pietons_droit nbr_touche_pietons_droit INT DEFAULT NULL, CHANGE nbr_touche_pietons_gauche nbr_touche_pietons_gauche INT DEFAULT NULL, CHANGE nbr_animal_touche_gauche nbr_animal_touche_gauche INT DEFAULT NULL, CHANGE nbr_animal_touche_droite nbr_animal_touche_droite INT DEFAULT NULL, CHANGE nbr_total_obstacle_touche_droit nbr_total_obstacle_touche_droit INT DEFAULT NULL, CHANGE nbr_total_obstacle_touche_gauche nbr_total_obstacle_touche_gauche INT DEFAULT NULL, CHANGE level level VARCHAR(255) DEFAULT NULL, CHANGE choix_jour_nuit choix_jour_nuit VARCHAR(255) DEFAULT NULL, CHANGE nbr_sortie_timer_gauche nbr_sortie_timer_gauche VARCHAR(255) DEFAULT NULL, CHANGE nbr_sortie_timer_droite nbr_sortie_timer_droite VARCHAR(255) DEFAULT NULL, CHANGE nbr_voiture_trop_proche nbr_voiture_trop_proche INT DEFAULT NULL, CHANGE date_session date_session VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP sujet');
        $this->addSql('ALTER TABLE patient CHANGE date_de_naissance date_de_naissance DATE DEFAULT \'NULL\', CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE prenom prenom VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE profession profession VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_enfants nbr_enfants INT DEFAULT NULL, CHANGE trouble_de_sommeil trouble_de_sommeil TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE session CHANGE patient_id patient_id INT DEFAULT NULL, CHANGE vitesse_moyenne vitesse_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE angle_deviation_moyenne angle_deviation_moyenne DOUBLE PRECISION DEFAULT \'NULL\', CHANGE nbr_totale_button_acceleration nbr_totale_button_acceleration INT DEFAULT NULL, CHANGE nbr_totale_button_frein nbr_totale_button_frein INT DEFAULT NULL, CHANGE nbr_rencontre_route_droite nbr_rencontre_route_droite INT DEFAULT NULL, CHANGE nbr_rencontre_route_gauche nbr_rencontre_route_gauche INT DEFAULT NULL, CHANGE vitesse_moyenne_zone_obstacle vitesse_moyenne_zone_obstacle DOUBLE PRECISION DEFAULT \'NULL\', CHANGE temps_de_reaction temps_de_reaction DOUBLE PRECISION DEFAULT \'NULL\', CHANGE nbr_touche_pietons_droit nbr_touche_pietons_droit INT DEFAULT NULL, CHANGE nbr_touche_pietons_gauche nbr_touche_pietons_gauche INT DEFAULT NULL, CHANGE nbr_animal_touche_gauche nbr_animal_touche_gauche INT DEFAULT NULL, CHANGE nbr_animal_touche_droite nbr_animal_touche_droite INT DEFAULT NULL, CHANGE nbr_total_obstacle_touche_droit nbr_total_obstacle_touche_droit INT DEFAULT NULL, CHANGE nbr_total_obstacle_touche_gauche nbr_total_obstacle_touche_gauche INT DEFAULT NULL, CHANGE level level VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE choix_jour_nuit choix_jour_nuit VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_sortie_timer_gauche nbr_sortie_timer_gauche VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_sortie_timer_droite nbr_sortie_timer_droite VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE nbr_voiture_trop_proche nbr_voiture_trop_proche INT DEFAULT NULL, CHANGE date_session date_session VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
