<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018124047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_registre ADD date_vote DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice_registre ADD date_adoption DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE exercice_registre ADD date_cloture DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE nomenclature ALTER annee_application TYPE VARCHAR(4)');
        $this->addSql('ALTER TABLE nomenclature ALTER annee_application DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE nomenclature ALTER annee_application TYPE INT');
        $this->addSql('ALTER TABLE nomenclature ALTER annee_application DROP DEFAULT');
        $this->addSql('ALTER TABLE nomenclature ALTER annee_application TYPE INT');
        $this->addSql('ALTER TABLE exercice_registre DROP date_vote');
        $this->addSql('ALTER TABLE exercice_registre DROP date_adoption');
        $this->addSql('ALTER TABLE exercice_registre DROP date_cloture');
    }
}
