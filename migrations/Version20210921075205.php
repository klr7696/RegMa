<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210921075205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_fonction DROP CONSTRAINT fk_8bb04640b0629113');
        $this->addSql('DROP INDEX idx_8bb04640b0629113');
        $this->addSql('ALTER TABLE compte_fonction RENAME COLUMN compte_fonctions_id TO compte_fonction_id');
        $this->addSql('ALTER TABLE compte_fonction ADD CONSTRAINT FK_8BB046407B991374 FOREIGN KEY (compte_fonction_id) REFERENCES compte_fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8BB046407B991374 ON compte_fonction (compte_fonction_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compte_fonction DROP CONSTRAINT FK_8BB046407B991374');
        $this->addSql('DROP INDEX IDX_8BB046407B991374');
        $this->addSql('ALTER TABLE compte_fonction RENAME COLUMN compte_fonction_id TO compte_fonctions_id');
        $this->addSql('ALTER TABLE compte_fonction ADD CONSTRAINT fk_8bb04640b0629113 FOREIGN KEY (compte_fonctions_id) REFERENCES compte_fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8bb04640b0629113 ON compte_fonction (compte_fonctions_id)');
    }
}
