<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211025080032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_ouvert DROP CONSTRAINT fk_24dca289f72f34');
        $this->addSql('ALTER TABLE allocation_credit DROP CONSTRAINT fk_23afd6a4ed92f166');
        $this->addSql('ALTER TABLE autorisation_marche DROP CONSTRAINT fk_28374edab4f84d49');
        $this->addSql('ALTER TABLE ressource_financiere DROP CONSTRAINT fk_2af6ea3ce9e54b0e');
        $this->addSql('DROP SEQUENCE lien_registre_id_seq CASCADE');
        $this->addSql('DROP TABLE lien_registre');
        $this->addSql('DROP INDEX uniq_23afd6a4ed92f166');
        $this->addSql('ALTER TABLE allocation_credit DROP association_allocation_actuel_id');
        $this->addSql('DROP INDEX uniq_28374edab4f84d49');
        $this->addSql('ALTER TABLE autorisation_marche DROP relation_modifier_id');
        $this->addSql('DROP INDEX uniq_24dca289f72f34');
        $this->addSql('ALTER TABLE credit_ouvert DROP association_credit_actuel_id');
        $this->addSql('ALTER TABLE exercice_registre DROP est_ajoutable');
        $this->addSql('DROP INDEX uniq_2af6ea3ce9e54b0e');
        $this->addSql('ALTER TABLE ressource_financiere DROP association_ressource_actuel_id');
        $this->addSql('ALTER TABLE statut_registre ADD est_ouvert BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE lien_registre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lien_registre (id INT NOT NULL, association_ressource_modifier_id INT DEFAULT NULL, association_credit_modifier_id INT DEFAULT NULL, association_allocation_modifier_id INT DEFAULT NULL, statut_registre_id INT DEFAULT NULL, relation_id INT DEFAULT NULL, description_motif TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_d10b6d8cf44461d3 ON lien_registre (association_allocation_modifier_id)');
        $this->addSql('CREATE INDEX idx_d10b6d8c2fd19c63 ON lien_registre (statut_registre_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d10b6d8c3256915b ON lien_registre (relation_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d10b6d8c1da245b3 ON lien_registre (association_credit_modifier_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_d10b6d8c72d4de99 ON lien_registre (association_ressource_modifier_id)');
        $this->addSql('ALTER TABLE lien_registre ADD CONSTRAINT fk_d10b6d8c72d4de99 FOREIGN KEY (association_ressource_modifier_id) REFERENCES ressource_financiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lien_registre ADD CONSTRAINT fk_d10b6d8c1da245b3 FOREIGN KEY (association_credit_modifier_id) REFERENCES credit_ouvert (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lien_registre ADD CONSTRAINT fk_d10b6d8cf44461d3 FOREIGN KEY (association_allocation_modifier_id) REFERENCES allocation_credit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lien_registre ADD CONSTRAINT fk_d10b6d8c2fd19c63 FOREIGN KEY (statut_registre_id) REFERENCES statut_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lien_registre ADD CONSTRAINT fk_d10b6d8c3256915b FOREIGN KEY (relation_id) REFERENCES autorisation_marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE credit_ouvert ADD association_credit_actuel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_ouvert ADD CONSTRAINT fk_24dca289f72f34 FOREIGN KEY (association_credit_actuel_id) REFERENCES lien_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_24dca289f72f34 ON credit_ouvert (association_credit_actuel_id)');
        $this->addSql('ALTER TABLE allocation_credit ADD association_allocation_actuel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE allocation_credit ADD CONSTRAINT fk_23afd6a4ed92f166 FOREIGN KEY (association_allocation_actuel_id) REFERENCES lien_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_23afd6a4ed92f166 ON allocation_credit (association_allocation_actuel_id)');
        $this->addSql('ALTER TABLE autorisation_marche ADD relation_modifier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE autorisation_marche ADD CONSTRAINT fk_28374edab4f84d49 FOREIGN KEY (relation_modifier_id) REFERENCES lien_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_28374edab4f84d49 ON autorisation_marche (relation_modifier_id)');
        $this->addSql('ALTER TABLE ressource_financiere ADD association_ressource_actuel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource_financiere ADD CONSTRAINT fk_2af6ea3ce9e54b0e FOREIGN KEY (association_ressource_actuel_id) REFERENCES lien_registre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_2af6ea3ce9e54b0e ON ressource_financiere (association_ressource_actuel_id)');
        $this->addSql('ALTER TABLE statut_registre DROP est_ouvert');
        $this->addSql('ALTER TABLE exercice_registre ADD est_ajoutable BOOLEAN NOT NULL');
    }
}
