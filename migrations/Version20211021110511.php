<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211021110511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_fonction ALTER numero_compte_fonction TYPE VARCHAR(7)');
        $this->addSql('ALTER TABLE compte_fonction ALTER numero_compte_fonction DROP DEFAULT');
        $this->addSql('ALTER TABLE compte_nature ALTER numero_compte_nature TYPE VARCHAR(7)');
        $this->addSql('ALTER TABLE compte_nature ALTER numero_compte_nature DROP DEFAULT');
        $this->addSql('ALTER TABLE exercice_registre ADD est_ajoutable BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE exercice_registre ALTER annee_exercice TYPE VARCHAR(4)');
        $this->addSql('ALTER TABLE exercice_registre ALTER annee_exercice DROP DEFAULT');
        $this->addSql('ALTER TABLE statut_registre DROP date_debut');
        $this->addSql('ALTER TABLE statut_registre DROP date_cloture');
        $this->addSql('ALTER TABLE statut_registre RENAME COLUMN description TO description_statut');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compte_nature ALTER numero_compte_nature TYPE INT');
        $this->addSql('ALTER TABLE compte_nature ALTER numero_compte_nature DROP DEFAULT');
        $this->addSql('ALTER TABLE compte_nature ALTER numero_compte_nature TYPE INT');
        $this->addSql('ALTER TABLE compte_fonction ALTER numero_compte_fonction TYPE INT');
        $this->addSql('ALTER TABLE compte_fonction ALTER numero_compte_fonction DROP DEFAULT');
        $this->addSql('ALTER TABLE compte_fonction ALTER numero_compte_fonction TYPE INT');
        $this->addSql('ALTER TABLE exercice_registre DROP est_ajoutable');
        $this->addSql('ALTER TABLE exercice_registre ALTER annee_exercice TYPE INT');
        $this->addSql('ALTER TABLE exercice_registre ALTER annee_exercice DROP DEFAULT');
        $this->addSql('ALTER TABLE exercice_registre ALTER annee_exercice TYPE INT');
        $this->addSql('ALTER TABLE statut_registre ADD date_debut DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_registre ADD date_cloture DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_registre RENAME COLUMN description_statut TO description');
    }
}
