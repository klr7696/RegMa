<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211025164436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_ouvert ADD actualise_credit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_ouvert ADD CONSTRAINT FK_24DCA281F649EDF FOREIGN KEY (actualise_credit_id) REFERENCES credit_ouvert (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24DCA281F649EDF ON credit_ouvert (actualise_credit_id)');
        $this->addSql('ALTER TABLE ressource_financiere ADD actualise_ressource_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource_financiere ADD CONSTRAINT FK_2AF6EA3C9ECE7024 FOREIGN KEY (actualise_ressource_id) REFERENCES ressource_financiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2AF6EA3C9ECE7024 ON ressource_financiere (actualise_ressource_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE credit_ouvert DROP CONSTRAINT FK_24DCA281F649EDF');
        $this->addSql('DROP INDEX UNIQ_24DCA281F649EDF');
        $this->addSql('ALTER TABLE credit_ouvert DROP actualise_credit_id');
        $this->addSql('ALTER TABLE ressource_financiere DROP CONSTRAINT FK_2AF6EA3C9ECE7024');
        $this->addSql('DROP INDEX UNIQ_2AF6EA3C9ECE7024');
        $this->addSql('ALTER TABLE ressource_financiere DROP actualise_ressource_id');
    }
}
