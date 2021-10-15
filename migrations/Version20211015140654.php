<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211015140654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_fonction DROP creation_at');
        $this->addSql('ALTER TABLE compte_nature DROP creation_at');
        $this->addSql('ALTER TABLE compte_nature ALTER section_compte_nature DROP NOT NULL');
        $this->addSql('ALTER TABLE lot_marche DROP CONSTRAINT fk_5d6fefa6bb3db540');
        $this->addSql('DROP INDEX uniq_5d6fefa6bb3db540');
        $this->addSql('ALTER TABLE lot_marche DROP association_lot_actuel_id');
        $this->addSql('ALTER TABLE nomenclature DROP reference_visa');
        $this->addSql('ALTER TABLE nomenclature DROP date_visa');
        $this->addSql('ALTER TABLE nomenclature DROP structure_visa');
        $this->addSql('ALTER TABLE nomenclature DROP creation_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nomenclature ADD reference_visa VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ADD date_visa DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ADD structure_visa VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ADD creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN nomenclature.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE compte_fonction ADD creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN compte_fonction.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE compte_nature ADD creation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE compte_nature ALTER section_compte_nature SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN compte_nature.creation_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE lot_marche ADD association_lot_actuel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lot_marche ADD CONSTRAINT fk_5d6fefa6bb3db540 FOREIGN KEY (association_lot_actuel_id) REFERENCES lien_plan (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_5d6fefa6bb3db540 ON lot_marche (association_lot_actuel_id)');
    }
}
