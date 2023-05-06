<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505223845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite ADD administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_549281977EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_549281977EE5403C ON actualite (administrateur_id)');
        $this->addSql('ALTER TABLE evenement ADD administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_B26681E7EE5403C ON evenement (administrateur_id)');
        $this->addSql('ALTER TABLE media ADD administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7EE5403C ON media (administrateur_id)');
        $this->addSql('ALTER TABLE membre ADD administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB297EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB297EE5403C ON membre (administrateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_549281977EE5403C');
        $this->addSql('DROP INDEX IDX_549281977EE5403C ON actualite');
        $this->addSql('ALTER TABLE actualite DROP administrateur_id');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E7EE5403C');
        $this->addSql('DROP INDEX IDX_B26681E7EE5403C ON evenement');
        $this->addSql('ALTER TABLE evenement DROP administrateur_id');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7EE5403C');
        $this->addSql('DROP INDEX IDX_6A2CA10C7EE5403C ON media');
        $this->addSql('ALTER TABLE media DROP administrateur_id');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB297EE5403C');
        $this->addSql('DROP INDEX IDX_F6B4FB297EE5403C ON membre');
        $this->addSql('ALTER TABLE membre DROP administrateur_id');
    }
}
