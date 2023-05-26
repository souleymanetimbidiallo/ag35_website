<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526160825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_549281977EE5403C');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E7EE5403C');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7EE5403C');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB297EE5403C');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP INDEX IDX_549281977EE5403C ON actualite');
        $this->addSql('ALTER TABLE actualite CHANGE photo photo VARCHAR(100) DEFAULT NULL, CHANGE administrateur_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_54928197642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_54928197642B8210 ON actualite (admin_id)');
        $this->addSql('DROP INDEX IDX_B26681E7EE5403C ON evenement');
        $this->addSql('ALTER TABLE evenement DROP lieu, CHANGE photo photo VARCHAR(100) DEFAULT NULL, CHANGE administrateur_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_B26681E642B8210 ON evenement (admin_id)');
        $this->addSql('DROP INDEX IDX_6A2CA10C7EE5403C ON media');
        $this->addSql('ALTER TABLE media ADD fichier VARCHAR(255) DEFAULT NULL, DROP file, CHANGE administrateur_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C642B8210 ON media (admin_id)');
        $this->addSql('DROP INDEX IDX_F6B4FB297EE5403C ON membre');
        $this->addSql('ALTER TABLE membre ADD image_name VARCHAR(255) DEFAULT NULL, DROP ville_actuelle, DROP pays_actuel, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE ville_origine ville_origine VARCHAR(20) DEFAULT NULL, CHANGE profession profession VARCHAR(30) DEFAULT NULL, CHANGE administrateur_id admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB29642B8210 ON membre (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_54928197642B8210');
        $this->addSql('DROP INDEX IDX_54928197642B8210 ON actualite');
        $this->addSql('ALTER TABLE actualite CHANGE photo photo VARBINARY(255) DEFAULT NULL, CHANGE admin_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_549281977EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_549281977EE5403C ON actualite (administrateur_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E642B8210');
        $this->addSql('DROP INDEX IDX_B26681E642B8210 ON evenement');
        $this->addSql('ALTER TABLE evenement ADD lieu VARCHAR(255) NOT NULL, CHANGE photo photo VARBINARY(255) DEFAULT NULL, CHANGE admin_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_B26681E7EE5403C ON evenement (administrateur_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C642B8210');
        $this->addSql('DROP INDEX IDX_6A2CA10C642B8210 ON media');
        $this->addSql('ALTER TABLE media ADD file LONGBLOB NOT NULL, DROP fichier, CHANGE admin_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7EE5403C ON media (administrateur_id)');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29642B8210');
        $this->addSql('DROP INDEX IDX_F6B4FB29642B8210 ON membre');
        $this->addSql('ALTER TABLE membre ADD ville_actuelle VARCHAR(20) NOT NULL, ADD pays_actuel VARCHAR(20) NOT NULL, DROP image_name, CHANGE email email VARCHAR(100) NOT NULL, CHANGE ville_origine ville_origine VARCHAR(20) NOT NULL, CHANGE profession profession VARCHAR(30) NOT NULL, CHANGE admin_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB297EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB297EE5403C ON membre (administrateur_id)');
    }
}
