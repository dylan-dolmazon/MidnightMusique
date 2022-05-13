<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220513084640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Appartient (id INT AUTO_INCREMENT NOT NULL, id_musique INT DEFAULT NULL, id_list INT DEFAULT NULL, importance VARCHAR(50) NOT NULL, INDEX list_number (id_list), INDEX musique_number (id_musique), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB9773080FFCC FOREIGN KEY (id_musique) REFERENCES musique (id)');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB977CFE8E41A FOREIGN KEY (id_list) REFERENCES list_musique (id)');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('ALTER TABLE evenement ADD password VARCHAR(50) NOT NULL, DROP yes');
        $this->addSql('ALTER TABLE list_musique ADD nom_list VARCHAR(50) NOT NULL, CHANGE id_evenement id_evenement INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT FK_32528BB18B13D439 FOREIGN KEY (id_evenement) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX id_evenement ON list_musique (id_evenement)');
        $this->addSql('ALTER TABLE musique ADD id_listmusique INT DEFAULT NULL, ADD titre VARCHAR(50) NOT NULL, DROP importance, CHANGE album album VARCHAR(255) DEFAULT NULL, CHANGE annee annee INT DEFAULT NULL, CHANGE style style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BC96ECBEE6 FOREIGN KEY (id_listmusique) REFERENCES list_musique (id)');
        $this->addSql('CREATE INDEX id_listmusique ON musique (id_listmusique)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, artist VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, album VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, annee INT NOT NULL, style VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE Appartient');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE evenement ADD yes VARCHAR(255) NOT NULL, DROP password');
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY FK_32528BB18B13D439');
        $this->addSql('DROP INDEX id_evenement ON list_musique');
        $this->addSql('ALTER TABLE list_musique DROP nom_list, CHANGE id_evenement id_evenement INT NOT NULL');
        $this->addSql('ALTER TABLE musique DROP FOREIGN KEY FK_EE1D56BC96ECBEE6');
        $this->addSql('DROP INDEX id_listmusique ON musique');
        $this->addSql('ALTER TABLE musique ADD importance VARCHAR(255) NOT NULL, DROP id_listmusique, DROP titre, CHANGE album album VARCHAR(255) NOT NULL, CHANGE annee annee INT NOT NULL, CHANGE style style VARCHAR(255) NOT NULL');
    }
}
