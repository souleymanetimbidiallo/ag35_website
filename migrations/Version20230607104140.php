<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607104140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mes_image (id INT AUTO_INCREMENT NOT NULL, image_name1 VARCHAR(255) DEFAULT NULL, image_name2 VARCHAR(255) DEFAULT NULL, image_name3 VARCHAR(255) DEFAULT NULL, image_name4 VARCHAR(255) DEFAULT NULL, image_name5 VARCHAR(255) DEFAULT NULL, image_name6 VARCHAR(255) DEFAULT NULL, image_name7 VARCHAR(255) DEFAULT NULL, image_name8 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE param_image DROP image_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mes_image');
        $this->addSql('ALTER TABLE param_image ADD image_name VARCHAR(255) DEFAULT NULL');
    }
}
