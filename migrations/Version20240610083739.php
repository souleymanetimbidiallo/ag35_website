<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610083739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adhesions CHANGE tarif tarif VARCHAR(255) NOT NULL, CHANGE montant montant NUMERIC(10, 0) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(50) NOT NULL, CHANGE adresse adresse VARCHAR(100) NOT NULL, CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD lien_billeterie VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adhesions CHANGE tarif tarif VARCHAR(255) DEFAULT NULL, CHANGE montant montant NUMERIC(10, 0) DEFAULT NULL, CHANGE type type VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE adresse adresse VARCHAR(100) DEFAULT NULL, CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement DROP lien_billeterie');
    }
}
