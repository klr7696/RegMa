<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210920093340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE compte_fonction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE compte_nature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE compte_fonction (id INT NOT NULL, nomenclature_id INT NOT NULL, sous_compte_fonction_id INT DEFAULT NULL, numero_compte_fonction INT NOT NULL, libelle_compte_fonction VARCHAR(255) NOT NULL, hiearachie_compte_fonction VARCHAR(30) NOT NULL, description_compte_fonction VARCHAR(255) DEFAULT NULL, creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8BB0464090BFD4B8 ON compte_fonction (nomenclature_id)');
        $this->addSql('CREATE INDEX IDX_8BB046405881511E ON compte_fonction (sous_compte_fonction_id)');
        $this->addSql('COMMENT ON COLUMN compte_fonction.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE compte_nature (id INT NOT NULL, nomenclature_id INT NOT NULL, sous_compte_nature_id INT DEFAULT NULL, numero_compte_nature INT NOT NULL, libelle_compte_nature VARCHAR(255) NOT NULL, section_compte_nature VARCHAR(30) NOT NULL, hierachie_compte_nature VARCHAR(30) NOT NULL, description_compte_nature VARCHAR(255) DEFAULT NULL, creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B41DB9090BFD4B8 ON compte_nature (nomenclature_id)');
        $this->addSql('CREATE INDEX IDX_6B41DB90BC8D4C47 ON compte_nature (sous_compte_nature_id)');
        $this->addSql('COMMENT ON COLUMN compte_nature.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE nomenclature (id INT NOT NULL, annee_application INT NOT NULL, decret_adoption VARCHAR(30) DEFAULT NULL, date_adoption DATE DEFAULT NULL, decret_application VARCHAR(30) DEFAULT NULL, date_application DATE DEFAULT NULL, reference_visa VARCHAR(30) DEFAULT NULL, date_visa DATE DEFAULT NULL, structure_visa VARCHAR(30) DEFAULT NULL, description_nomenclature VARCHAR(255) DEFAULT NULL, creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN nomenclature.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE compte_fonction ADD CONSTRAINT FK_8BB0464090BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte_fonction ADD CONSTRAINT FK_8BB046405881511E FOREIGN KEY (sous_compte_fonction_id) REFERENCES compte_fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte_nature ADD CONSTRAINT FK_6B41DB9090BFD4B8 FOREIGN KEY (nomenclature_id) REFERENCES nomenclature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte_nature ADD CONSTRAINT FK_6B41DB90BC8D4C47 FOREIGN KEY (sous_compte_nature_id) REFERENCES compte_nature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compte_fonction DROP CONSTRAINT FK_8BB046405881511E');
        $this->addSql('ALTER TABLE compte_nature DROP CONSTRAINT FK_6B41DB90BC8D4C47');
        $this->addSql('ALTER TABLE compte_fonction DROP CONSTRAINT FK_8BB0464090BFD4B8');
        $this->addSql('ALTER TABLE compte_nature DROP CONSTRAINT FK_6B41DB9090BFD4B8');
        $this->addSql('DROP SEQUENCE compte_fonction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE compte_nature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_id_seq CASCADE');
        $this->addSql('DROP TABLE compte_fonction');
        $this->addSql('DROP TABLE compte_nature');
        $this->addSql('DROP TABLE nomenclature');
    }
}
