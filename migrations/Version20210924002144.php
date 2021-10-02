<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924002144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE allocation_credit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE autorisation_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bailleur_fonds_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE bon_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contrat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE credit_ouvert_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE decision_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE engagement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exception_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exercice_registre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE imputation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_commande_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lot_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mairie_communale_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mandatement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE membre_commission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mode_passation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offre_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE participant_commission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE phase_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plan_passation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE projet_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ressource_financiere_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE soumission_marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE soumissionnaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE allocation_credit (id INT NOT NULL, credit_ouvert_id INT NOT NULL, montant_allouer DOUBLE PRECISION NOT NULL, description_allocation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23AFD6A46967D083 ON allocation_credit (credit_ouvert_id)');
        $this->addSql('CREATE TABLE autorisation_marche (id INT NOT NULL, objet_autorisation VARCHAR(1000) NOT NULL, montant_autorisation DOUBLE PRECISION NOT NULL, explication_autorisation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bailleur_fonds (id INT NOT NULL, designation_bailleur VARCHAR(100) NOT NULL, sigle_bailleur VARCHAR(10) NOT NULL, categorie_bailleur VARCHAR(50) NOT NULL, code_bailleur VARCHAR(10) NOT NULL, source_financement VARCHAR(255) NOT NULL, description_bailleur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bon_commande (id INT NOT NULL, contrat_id INT NOT NULL, numero_bon INT NOT NULL, montant_bon DOUBLE PRECISION NOT NULL, date_demarrage DATE DEFAULT NULL, delai_execution INT DEFAULT NULL, date_reception_normal DATE DEFAULT NULL, date_reception_effective DATE DEFAULT NULL, est_receptioner BOOLEAN NOT NULL, lieu_reception VARCHAR(255) DEFAULT NULL, montant_penalite DOUBLE PRECISION DEFAULT NULL, objet_penalite TEXT DEFAULT NULL, description_reception TEXT DEFAULT NULL, description_bon TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_159D95761823061F ON bon_commande (contrat_id)');
        $this->addSql('CREATE TABLE commission (id INT NOT NULL, type_commission VARCHAR(255) NOT NULL, reference_convocation VARCHAR(100) NOT NULL, objet_convocation VARCHAR(500) NOT NULL, date_convocation DATE NOT NULL, description_convocation TEXT DEFAULT NULL, date_notification DATE DEFAULT NULL, date_debut_session DATE DEFAULT NULL, date_fin_session DATE DEFAULT NULL, synthese_session_ouverture TEXT DEFAULT NULL, heure_debut_session TIME(0) WITHOUT TIME ZONE DEFAULT NULL, heure_fin_session_ouverture TIME(0) WITHOUT TIME ZONE DEFAULT NULL, heure_debut_session_fermeture TIME(0) WITHOUT TIME ZONE DEFAULT NULL, heure_fin_session_fermeture TIME(0) WITHOUT TIME ZONE DEFAULT NULL, synthese_fermeture TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contrat (id INT NOT NULL, marche_id INT DEFAULT NULL, type_contrat VARCHAR(50) NOT NULL, montant_minimum DOUBLE PRECISION DEFAULT NULL, montant_minimum_lettre VARCHAR(500) DEFAULT NULL, montant_maximum DOUBLE PRECISION DEFAULT NULL, montant_maximum_lettre VARCHAR(500) DEFAULT NULL, numero_contrat INT NOT NULL, reference_contrat VARCHAR(255) NOT NULL, date_approbation DATE DEFAULT NULL, date_notification DATE DEFAULT NULL, est_approuver BOOLEAN NOT NULL, description_contrat TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_603499939E494911 ON contrat (marche_id)');
        $this->addSql('CREATE TABLE credit_ouvert (id INT NOT NULL, ressource_financiere_id INT NOT NULL, montant_inscription DOUBLE PRECISION NOT NULL, description_inscription VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_24DCA28BB7F95A1 ON credit_ouvert (ressource_financiere_id)');
        $this->addSql('CREATE TABLE decision_marche (id INT NOT NULL, projet_marche_id INT DEFAULT NULL, objet_decision VARCHAR(500) DEFAULT NULL, numero_decision INT NOT NULL, reference_decision VARCHAR(255) DEFAULT NULL, date_decision DATE DEFAULT NULL, est_publier BOOLEAN NOT NULL, journal_publication VARCHAR(255) DEFAULT NULL, numero_publication INT DEFAULT NULL, date_publication DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C35A77AFBDB7AEC5 ON decision_marche (projet_marche_id)');
        $this->addSql('CREATE TABLE engagement (id INT NOT NULL, emission_id INT DEFAULT NULL, type_operation VARCHAR(50) NOT NULL, montant_operation DOUBLE PRECISION NOT NULL, date_operation DATE NOT NULL, reference_operation VARCHAR(100) DEFAULT NULL, description_operation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D86F014117E24D70 ON engagement (emission_id)');
        $this->addSql('CREATE TABLE exception_marche (id INT NOT NULL, plan_passation_id INT NOT NULL, autorisation_marche_id INT NOT NULL, type_exception VARCHAR(100) NOT NULL, objet_exception VARCHAR(500) DEFAULT NULL, montant_exception DOUBLE PRECISION NOT NULL, observation_exception VARCHAR(255) DEFAULT NULL, delai_excecution INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A100FA2B207B8E1 ON exception_marche (plan_passation_id)');
        $this->addSql('CREATE INDEX IDX_5A100FA23018B27A ON exception_marche (autorisation_marche_id)');
        $this->addSql('CREATE TABLE exercice_registre (id INT NOT NULL, annee_exercice INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE imputation (id INT NOT NULL, engagement_id INT DEFAULT NULL, mandatement_id INT DEFAULT NULL, type_imputation VARCHAR(50) NOT NULL, montant_imputation DOUBLE PRECISION NOT NULL, description_imputation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE81A25AD30F6F97 ON imputation (engagement_id)');
        $this->addSql('CREATE INDEX IDX_AE81A25AFAF1DD83 ON imputation (mandatement_id)');
        $this->addSql('CREATE TABLE item_commande (id INT NOT NULL, bon_commande_id INT NOT NULL, designation_item VARCHAR(500) NOT NULL, unite_item VARCHAR(100) DEFAULT NULL, prix_unitaire_item DOUBLE PRECISION NOT NULL, quantite_item INT NOT NULL, est_conforme BOOLEAN NOT NULL, description_item TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2E76EB6B4B54061 ON item_commande (bon_commande_id)');
        $this->addSql('CREATE TABLE lot_marche (id INT NOT NULL, plan_passation_id INT NOT NULL, autorisation_marche_id INT NOT NULL, numero_lot INT NOT NULL, objet_lot VARCHAR(500) NOT NULL, montant_lot DOUBLE PRECISION NOT NULL, observation_lot VARCHAR(255) DEFAULT NULL, delai_execution INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5D6FEFA6B207B8E1 ON lot_marche (plan_passation_id)');
        $this->addSql('CREATE INDEX IDX_5D6FEFA63018B27A ON lot_marche (autorisation_marche_id)');
        $this->addSql('CREATE TABLE mairie_communale (id INT NOT NULL, designation_mairie VARCHAR(100) NOT NULL, abbreviation_mairie VARCHAR(10) NOT NULL, adresse_mairie VARCHAR(255) NOT NULL, description_mairie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mandatement (id INT NOT NULL, engagement_id INT NOT NULL, emission_id INT DEFAULT NULL, type_operation VARCHAR(50) NOT NULL, montant_operation DOUBLE PRECISION NOT NULL, date_operation DATE NOT NULL, reference_operation VARCHAR(100) DEFAULT NULL, description TEXT DEFAULT NULL, reglement VARCHAR(100) DEFAULT NULL, compte_creance VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C904D448D30F6F97 ON mandatement (engagement_id)');
        $this->addSql('CREATE INDEX IDX_C904D44817E24D70 ON mandatement (emission_id)');
        $this->addSql('CREATE TABLE membre_commission (id INT NOT NULL, matricule VARCHAR(100) DEFAULT NULL, nom_membre VARCHAR(255) NOT NULL, service_membre VARCHAR(255) DEFAULT NULL, fonction_service VARCHAR(100) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mode_passation (id INT NOT NULL, designation_mode VARCHAR(100) NOT NULL, abbreviation_mode VARCHAR(10) NOT NULL, categorie_mode VARCHAR(100) NOT NULL, nature_prestation VARCHAR(100) NOT NULL, seuils_minimum DOUBLE PRECISION NOT NULL, seuils_maximum DOUBLE PRECISION NOT NULL, description_mode VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE offre_marche (id INT NOT NULL, soumissionnaire_id INT NOT NULL, soumission_marche_id INT NOT NULL, montant_minimum_offre DOUBLE PRECISION DEFAULT NULL, montant_minimum_corriger DOUBLE PRECISION DEFAULT NULL, montant_minimum_arreter DOUBLE PRECISION DEFAULT NULL, montant_maximum_offre DOUBLE PRECISION DEFAULT NULL, montant_maximum_corriger DOUBLE PRECISION DEFAULT NULL, montant_maximum_arreter DOUBLE PRECISION DEFAULT NULL, difference_minimum DOUBLE PRECISION DEFAULT NULL, difference_maximum DOUBLE PRECISION DEFAULT NULL, garanti_offre DOUBLE PRECISION DEFAULT NULL, adresse_garantie VARCHAR(255) DEFAULT NULL, compte_reglement VARCHAR(100) DEFAULT NULL, piece_non_fournir TEXT DEFAULT NULL, est_recevable BOOLEAN NOT NULL, est_taxer BOOLEAN NOT NULL, est_conforme BOOLEAN NOT NULL, classement_offre INT DEFAULT NULL, delai_execution INT DEFAULT NULL, delai_engagement INT DEFAULT NULL, remarque_offre TEXT DEFAULT NULL, date_transmission DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DD2BEAE7D29926FB ON offre_marche (soumissionnaire_id)');
        $this->addSql('CREATE INDEX IDX_DD2BEAE78F2C3BA7 ON offre_marche (soumission_marche_id)');
        $this->addSql('CREATE TABLE participant_commission (id INT NOT NULL, membre_commission_id INT NOT NULL, commission_id INT NOT NULL, fonction_participant VARCHAR(100) NOT NULL, estpresent BOOLEAN NOT NULL, service_represente VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20A5E746786F080 ON participant_commission (membre_commission_id)');
        $this->addSql('CREATE INDEX IDX_20A5E746202D1EB2 ON participant_commission (commission_id)');
        $this->addSql('CREATE TABLE phase_marche (id INT NOT NULL, projet_marche_id INT NOT NULL, type_phase VARCHAR(50) NOT NULL, debut_publicite DATE DEFAULT NULL, fin_publicite DATE DEFAULT NULL, duree_publicite INT NOT NULL, debut_remise_offre DATE DEFAULT NULL, fin_remise_offre DATE DEFAULT NULL, duree_remise_offre INT NOT NULL, date_demarrage DATE NOT NULL, temps_evaluation INT NOT NULL, date_ouverture_plis DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_476BC56BDB7AEC5 ON phase_marche (projet_marche_id)');
        $this->addSql('CREATE TABLE plan_passation (id INT NOT NULL, president_commission VARCHAR(100) DEFAULT NULL, ordonnateur_plan VARCHAR(100) NOT NULL, adresse_depouillement VARCHAR(255) DEFAULT NULL, description_plan VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE projet_marche (id INT NOT NULL, mode_passation_id INT NOT NULL, objet_marche TEXT DEFAULT NULL, numero_projet INT NOT NULL, reference_projet VARCHAR(255) NOT NULL, priorite_projet INT NOT NULL, specificite_projet VARCHAR(255) DEFAULT NULL, piece_fournir TEXT DEFAULT NULL, prix_dossier DOUBLE PRECISION DEFAULT NULL, proposition_minimum DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98083A9AE29FB31A ON projet_marche (mode_passation_id)');
        $this->addSql('CREATE TABLE ressource_financiere (id INT NOT NULL, exercice_registre_id INT NOT NULL, bailleur_fonds_id INT NOT NULL, objet_financement VARCHAR(100) NOT NULL, mode_financement VARCHAR(100) NOT NULL, montant_financement DOUBLE PRECISION NOT NULL, description_financement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AF6EA3C7D38C322 ON ressource_financiere (exercice_registre_id)');
        $this->addSql('CREATE INDEX IDX_2AF6EA3C4A5D0223 ON ressource_financiere (bailleur_fonds_id)');
        $this->addSql('CREATE TABLE soumission_marche (id INT NOT NULL, soumissionnaire_id INT NOT NULL, numero_retrait INT NOT NULL, numero_quittance VARCHAR(100) NOT NULL, nom_represantant_retrait VARCHAR(100) DEFAULT NULL, nom_represantant_depot VARCHAR(100) DEFAULT NULL, nom_represantant_annulation VARCHAR(100) DEFAULT NULL, contact_retrait VARCHAR(255) DEFAULT NULL, contact_depot VARCHAR(255) DEFAULT NULL, contact_annulation VARCHAR(255) DEFAULT NULL, date_retrait DATE DEFAULT NULL, date_depot DATE DEFAULT NULL, date_annulation DATE DEFAULT NULL, numero_depot INT DEFAULT NULL, heure_depot TIME(0) WITHOUT TIME ZONE DEFAULT NULL, est_recevable BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4F53C395D29926FB ON soumission_marche (soumissionnaire_id)');
        $this->addSql('CREATE TABLE soumissionnaire (id INT NOT NULL, numero_ifu VARCHAR(100) NOT NULL, designation_entreprise VARCHAR(255) NOT NULL, sigle_entreprise VARCHAR(10) DEFAULT NULL, adresse_entreprise VARCHAR(255) NOT NULL, description_entreprise VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE allocation_credit ADD CONSTRAINT FK_23AFD6A46967D083 FOREIGN KEY (credit_ouvert_id) REFERENCES credit_ouvert (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bon_commande ADD CONSTRAINT FK_159D95761823061F FOREIGN KEY (contrat_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499939E494911 FOREIGN KEY (marche_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit_ouvert ADD CONSTRAINT FK_24DCA28BB7F95A1 FOREIGN KEY (ressource_financiere_id) REFERENCES ressource_financiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE decision_marche ADD CONSTRAINT FK_C35A77AFBDB7AEC5 FOREIGN KEY (projet_marche_id) REFERENCES projet_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE engagement ADD CONSTRAINT FK_D86F014117E24D70 FOREIGN KEY (emission_id) REFERENCES engagement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exception_marche ADD CONSTRAINT FK_5A100FA2B207B8E1 FOREIGN KEY (plan_passation_id) REFERENCES plan_passation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exception_marche ADD CONSTRAINT FK_5A100FA23018B27A FOREIGN KEY (autorisation_marche_id) REFERENCES autorisation_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE imputation ADD CONSTRAINT FK_AE81A25AD30F6F97 FOREIGN KEY (engagement_id) REFERENCES engagement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE imputation ADD CONSTRAINT FK_AE81A25AFAF1DD83 FOREIGN KEY (mandatement_id) REFERENCES mandatement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item_commande ADD CONSTRAINT FK_2E76EB6B4B54061 FOREIGN KEY (bon_commande_id) REFERENCES bon_commande (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lot_marche ADD CONSTRAINT FK_5D6FEFA6B207B8E1 FOREIGN KEY (plan_passation_id) REFERENCES plan_passation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lot_marche ADD CONSTRAINT FK_5D6FEFA63018B27A FOREIGN KEY (autorisation_marche_id) REFERENCES autorisation_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mandatement ADD CONSTRAINT FK_C904D448D30F6F97 FOREIGN KEY (engagement_id) REFERENCES engagement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mandatement ADD CONSTRAINT FK_C904D44817E24D70 FOREIGN KEY (emission_id) REFERENCES mandatement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_marche ADD CONSTRAINT FK_DD2BEAE7D29926FB FOREIGN KEY (soumissionnaire_id) REFERENCES soumissionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_marche ADD CONSTRAINT FK_DD2BEAE78F2C3BA7 FOREIGN KEY (soumission_marche_id) REFERENCES soumission_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_commission ADD CONSTRAINT FK_20A5E746786F080 FOREIGN KEY (membre_commission_id) REFERENCES membre_commission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE participant_commission ADD CONSTRAINT FK_20A5E746202D1EB2 FOREIGN KEY (commission_id) REFERENCES commission (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE phase_marche ADD CONSTRAINT FK_476BC56BDB7AEC5 FOREIGN KEY (projet_marche_id) REFERENCES projet_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE projet_marche ADD CONSTRAINT FK_98083A9AE29FB31A FOREIGN KEY (mode_passation_id) REFERENCES mode_passation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ressource_financiere ADD CONSTRAINT FK_2AF6EA3C7D38C322 FOREIGN KEY (exercice_registre_id) REFERENCES exercice_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ressource_financiere ADD CONSTRAINT FK_2AF6EA3C4A5D0223 FOREIGN KEY (bailleur_fonds_id) REFERENCES bailleur_fonds (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE soumission_marche ADD CONSTRAINT FK_4F53C395D29926FB FOREIGN KEY (soumissionnaire_id) REFERENCES soumissionnaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE exception_marche DROP CONSTRAINT FK_5A100FA23018B27A');
        $this->addSql('ALTER TABLE lot_marche DROP CONSTRAINT FK_5D6FEFA63018B27A');
        $this->addSql('ALTER TABLE ressource_financiere DROP CONSTRAINT FK_2AF6EA3C4A5D0223');
        $this->addSql('ALTER TABLE item_commande DROP CONSTRAINT FK_2E76EB6B4B54061');
        $this->addSql('ALTER TABLE participant_commission DROP CONSTRAINT FK_20A5E746202D1EB2');
        $this->addSql('ALTER TABLE bon_commande DROP CONSTRAINT FK_159D95761823061F');
        $this->addSql('ALTER TABLE contrat DROP CONSTRAINT FK_603499939E494911');
        $this->addSql('ALTER TABLE allocation_credit DROP CONSTRAINT FK_23AFD6A46967D083');
        $this->addSql('ALTER TABLE engagement DROP CONSTRAINT FK_D86F014117E24D70');
        $this->addSql('ALTER TABLE imputation DROP CONSTRAINT FK_AE81A25AD30F6F97');
        $this->addSql('ALTER TABLE mandatement DROP CONSTRAINT FK_C904D448D30F6F97');
        $this->addSql('ALTER TABLE ressource_financiere DROP CONSTRAINT FK_2AF6EA3C7D38C322');
        $this->addSql('ALTER TABLE imputation DROP CONSTRAINT FK_AE81A25AFAF1DD83');
        $this->addSql('ALTER TABLE mandatement DROP CONSTRAINT FK_C904D44817E24D70');
        $this->addSql('ALTER TABLE participant_commission DROP CONSTRAINT FK_20A5E746786F080');
        $this->addSql('ALTER TABLE projet_marche DROP CONSTRAINT FK_98083A9AE29FB31A');
        $this->addSql('ALTER TABLE exception_marche DROP CONSTRAINT FK_5A100FA2B207B8E1');
        $this->addSql('ALTER TABLE lot_marche DROP CONSTRAINT FK_5D6FEFA6B207B8E1');
        $this->addSql('ALTER TABLE decision_marche DROP CONSTRAINT FK_C35A77AFBDB7AEC5');
        $this->addSql('ALTER TABLE phase_marche DROP CONSTRAINT FK_476BC56BDB7AEC5');
        $this->addSql('ALTER TABLE credit_ouvert DROP CONSTRAINT FK_24DCA28BB7F95A1');
        $this->addSql('ALTER TABLE offre_marche DROP CONSTRAINT FK_DD2BEAE78F2C3BA7');
        $this->addSql('ALTER TABLE offre_marche DROP CONSTRAINT FK_DD2BEAE7D29926FB');
        $this->addSql('ALTER TABLE soumission_marche DROP CONSTRAINT FK_4F53C395D29926FB');
        $this->addSql('DROP SEQUENCE allocation_credit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE autorisation_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bailleur_fonds_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE bon_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contrat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE credit_ouvert_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE decision_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE engagement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exception_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exercice_registre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE imputation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_commande_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lot_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mairie_communale_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mandatement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE membre_commission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mode_passation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offre_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE participant_commission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE phase_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plan_passation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE projet_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ressource_financiere_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE soumission_marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE soumissionnaire_id_seq CASCADE');
        $this->addSql('DROP TABLE allocation_credit');
        $this->addSql('DROP TABLE autorisation_marche');
        $this->addSql('DROP TABLE bailleur_fonds');
        $this->addSql('DROP TABLE bon_commande');
        $this->addSql('DROP TABLE commission');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE credit_ouvert');
        $this->addSql('DROP TABLE decision_marche');
        $this->addSql('DROP TABLE engagement');
        $this->addSql('DROP TABLE exception_marche');
        $this->addSql('DROP TABLE exercice_registre');
        $this->addSql('DROP TABLE imputation');
        $this->addSql('DROP TABLE item_commande');
        $this->addSql('DROP TABLE lot_marche');
        $this->addSql('DROP TABLE mairie_communale');
        $this->addSql('DROP TABLE mandatement');
        $this->addSql('DROP TABLE membre_commission');
        $this->addSql('DROP TABLE mode_passation');
        $this->addSql('DROP TABLE offre_marche');
        $this->addSql('DROP TABLE participant_commission');
        $this->addSql('DROP TABLE phase_marche');
        $this->addSql('DROP TABLE plan_passation');
        $this->addSql('DROP TABLE projet_marche');
        $this->addSql('DROP TABLE ressource_financiere');
        $this->addSql('DROP TABLE soumission_marche');
        $this->addSql('DROP TABLE soumissionnaire');
    }
}
