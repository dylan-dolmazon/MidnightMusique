<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513083352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Appartient (id INT AUTO_INCREMENT NOT NULL, id_musique INT DEFAULT NULL, id_list INT DEFAULT NULL, importance VARCHAR(50) NOT NULL, INDEX list_number (id_list), INDEX musique_number (id_musique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, theme VARCHAR(255) DEFAULT NULL, nb_invite INT DEFAULT NULL, occasion VARCHAR(255) NOT NULL, lieux VARCHAR(255) DEFAULT NULL, password VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE list_musique (id INT AUTO_INCREMENT NOT NULL, id_evenement INT DEFAULT NULL, nom_list VARCHAR(50) NOT NULL, INDEX id_evenement (id_evenement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musique (id INT AUTO_INCREMENT NOT NULL, id_listmusique INT DEFAULT NULL, artist VARCHAR(255) NOT NULL, album VARCHAR(255) DEFAULT NULL, annee INT DEFAULT NULL, style VARCHAR(255) DEFAULT NULL, titre VARCHAR(50) NOT NULL, INDEX id_listmusique (id_listmusique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB9773080FFCC FOREIGN KEY (id_musique) REFERENCES musique (id)');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB977CFE8E41A FOREIGN KEY (id_list) REFERENCES list_musique (id)');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT FK_32528BB18B13D439 FOREIGN KEY (id_evenement) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BC96ECBEE6 FOREIGN KEY (id_listmusique) REFERENCES list_musique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY FK_32528BB18B13D439');
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY FK_D5CB977CFE8E41A');
        $this->addSql('ALTER TABLE musique DROP FOREIGN KEY FK_EE1D56BC96ECBEE6');
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY FK_D5CB9773080FFCC');
        $this->addSql('DROP TABLE Appartient');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE list_musique');
        $this->addSql('DROP TABLE musique');
        $this->addSql('DROP TABLE user');
    }
}
