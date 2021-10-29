<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029130051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_registre ADD est_cloture BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE exercice_registre RENAME COLUMN est_en_cours TO est_ouvert');
        $this->addSql('ALTER TABLE statut_registre ADD est_en_cours BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE statut_registre ADD date_approbation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE statut_registre ADD est_actualisable BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE statut_registre DROP est_cloturer');
        $this->addSql('ALTER TABLE statut_registre DROP est_ouvert');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE statut_registre ADD est_cloturer BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE statut_registre ADD est_ouvert BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE statut_registre DROP est_en_cours');
        $this->addSql('ALTER TABLE statut_registre DROP date_approbation');
        $this->addSql('ALTER TABLE statut_registre DROP est_actualisable');
        $this->addSql('ALTER TABLE exercice_registre ADD est_en_cours BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE exercice_registre DROP est_ouvert');
        $this->addSql('ALTER TABLE exercice_registre DROP est_cloture');
    }
}
