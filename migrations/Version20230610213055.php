<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230610213055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, date_publication DATETIME NOT NULL, image_name VARCHAR(255) DEFAULT NULL, INDEX IDX_54928197642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, titre VARCHAR(50) DEFAULT NULL, message VARCHAR(255) NOT NULL, date_message DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, nom_donateur VARCHAR(80) NOT NULL, email VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, telephone VARCHAR(30) NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, commentaire VARCHAR(100) DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, adresse VARCHAR(100) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, prix VARCHAR(255) NOT NULL, INDEX IDX_B26681E642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guide (id INT AUTO_INCREMENT NOT NULL, pdf_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(50) NOT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_6A2CA10C642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(100) DEFAULT NULL, telephone VARCHAR(30) NOT NULL, ville_origine VARCHAR(20) DEFAULT NULL, profession VARCHAR(30) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, date_adhesion DATE NOT NULL, bureau TINYINT(1) NOT NULL, fonction VARCHAR(30) DEFAULT NULL, INDEX IDX_F6B4FB29642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, lien VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mes_image (id INT AUTO_INCREMENT NOT NULL, image_name1 VARCHAR(255) DEFAULT NULL, image_name2 VARCHAR(255) DEFAULT NULL, image_name3 VARCHAR(255) DEFAULT NULL, image_name4 VARCHAR(255) DEFAULT NULL, image_name5 VARCHAR(255) DEFAULT NULL, image_name6 VARCHAR(255) DEFAULT NULL, image_name7 VARCHAR(255) DEFAULT NULL, image_name8 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param_image (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, valeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(50) DEFAULT NULL, descriptif VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE temoin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, fonction VARCHAR(30) DEFAULT NULL, descriptif VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE valeur (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(30) NOT NULL, descriptif VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_54928197642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');

        $this->addSql("INSERT INTO actualite (admin_id, titre, description, date_publication) VALUES (1, 'Titre de l''actualité', 'Description de l''actualité', NOW())");
        $this->addSql("INSERT INTO actualite (admin_id, titre, description, date_publication) VALUES (1, 'Nouvelle actualité', 'Description de la nouvelle actualité', NOW())");
        $this->addSql("INSERT INTO actualite (admin_id, titre, description, date_publication) VALUES (1, 'Actualité importante', 'Description de l\'actualité importante', NOW())");

        $this->addSql("INSERT INTO admin (email, roles, password, nom, prenom) VALUES (1, 'yayakomara56@gmail.com', '[\"ROLE_ADMIN\"]', 'demo', 'Komara', 'Yaya')");

        $this->addSql("INSERT INTO evenement (id, admin_id, titre, commentaire, date_debut, date_fin, adresse, prix, image_name) VALUES (2, NULL, '4. Union', 'je suis l''evenement1', '2023-06-06 13:33:32', '2023-06-06 13:33:32', '7 rue jean monet', '50 euros', 'evenement1.jpg')");
        $this->addSql("INSERT INTO evenement (id, admin_id, titre, commentaire, date_debut, date_fin, adresse, prix, image_name) VALUES (3, NULL, '2. Engagement', 'je suis l''evenement 2', '2023-06-06 13:33:32', '2023-06-06 13:33:32', '7 rue prof charles', '70 euros', 'evenement2.jpg')");
        $this->addSql("INSERT INTO evenement (id, admin_id, titre, commentaire, date_debut, date_fin, adresse, prix, image_name) VALUES (4, NULL, 'journée mondiale', 'evenement 3', '2023-06-15 13:51:00', '2023-06-30 13:51:00', '56 Rue louis vuitton', '100', 'evenement3.jpg')");

        $this->addSql("INSERT INTO membre (id, admin_id, nom, prenom, email, telephone, ville_origine, profession, date_adhesion, bureau, fonction, image_name) VALUES (1, NULL, 'condé', 'hady', 'condehady90@gmail.com', '0753037847', 'Rennes', 'trésorier', '2023-05-12', 1, 'trésorier', 'IMG_20200905_181929 (1)-min.jpg')");

        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (1, 'accueil', 'Accueil'),");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (2, 'apropos', 'A propos')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (3, 'activite', 'Activité')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (4, 'multimedia', 'Multimedia')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (5, 'donation', 'Donation')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (6, 'adhesion', 'Adhesion')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (7, 'contact', 'Contact')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (8, 'evenement', 'Evenement')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (9, 'actualite', 'Actualité')");
        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (10, 'guide', 'Guide')");

        $this->addSql("INSERT INTO menu (id, nom, lien) VALUES (10, 'guide', 'Guide')");


        $this->addSql("INSERT INTO mes_image (id, image_name1, image_name2, image_name3, image_name4, image_name5, image_name6, image_name7, image_name8) VALUES (1, NULL, 'fond2.jpg', 'fond3.jpg', 'fond1.jpg', NULL, NULL, NULL, NULL);");

        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (2, 'site_adresse', '40 Boulevard Jeanne D''Arc 35000 Rennes')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (3, 'site_telephone', '+33 6 26 69 53 03')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (4, 'site_email', 'assoguinée@gmail.com')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (5, 'lien_page_fb', 'https://www.facebook.com/profile.php?id=100090531087557')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (6, 'lien_groupe_fb', 'https://www.facebook.com/groups/277419572894')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (7, 'lien_whatsApp', 'https://chat.whatsapp.com/CEwnOWS4VreAefOIy0kq3v')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (8, 'logo', 'guinea.png')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (14, 'nom_association', 'Association guinéenne d''Ille-et-Vilaine')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (27, 'fond1', 'fond1.jpg')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (28, 'fond3', 'fond3.jpeg')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (29, 'fond2', 'fond2.jpg')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (30, 'site_logo', 'ag35_logo.png')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (31, 'titre_accueil_video', 'Cliquer ci-dessus pour regarder la présentation de l''AG35')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (32, 'titre_accueil_event', 'Nos derniers événements')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (34, 'titre_accueil_temoin', 'Ce que les gens disent de nos services !')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (35, 'nos_valeurs', 'Nos valeurs')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (36, 'nos_gouvernances', 'Gouvernance & Bureau')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (37, 'nos_partenaires', 'Partenaires et Sponsors')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (38, 'texte_nos_valeurs', 'Nous croyons en ces valeurs et les portons dans toutes nos activités. Elles nous distinguent et nous définissent.')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (39, 'texte_nos_gouvernances', 'L''association Guinéenne d''Ille et vilaine AG35 est composée d''une assemblée générale, d''un bureau exécutif, des membres actifs ou adhérents, des membres d''honneur, bienfaiteurs et sympathisants.')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (40, 'texte_nos_partenaires', 'Nous travaillons avec différents acteurs institutionnels, associatifs et des startups qui nous accompagnent dans nos différentes activités.')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (41, 'site_nous_sommes', 'Nous sommes')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (42, 'site_name', 'AG35')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (44, 'lien_presentation_youtube', 'https://www.youtube.com/watch?v=31U4GWsYUVw')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (45, 'lien_billeterie', 'https://www.helloasso.com/associations/association-guineenne-d-ile-et-vilaine-ag35/formulaires/1')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (46, 'lien_actualite', 'https://www.afroguinee.com/tag/miss-guinee/')");
        $this->addSql("INSERT INTO parametre (id, nom, valeur) VALUES (47, 'lien_adhesion', 'https://www.helloasso.com/associations/association-guineenne-d-ile-et-vilaine-ag35/adhesions/adhesion-a-ag35')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_54928197642B8210');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E642B8210');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C642B8210');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29642B8210');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE donation');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE guide');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE mes_image');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE param_image');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE temoin');
        $this->addSql('DROP TABLE valeur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
