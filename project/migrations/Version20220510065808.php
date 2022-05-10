<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510065808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY list_number');
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY musique_number');
        $this->addSql('ALTER TABLE Appartient CHANGE id_list id_list INT DEFAULT NULL, CHANGE id_musique id_musique INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB977CFE8E41A FOREIGN KEY (id_list) REFERENCES list_musique (id)');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT FK_D5CB9773080FFCC FOREIGN KEY (id_musique) REFERENCES musique (id)');
        $this->addSql('ALTER TABLE evenement DROP password');
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY id_evenement');
        $this->addSql('ALTER TABLE list_musique CHANGE id_evenement id_evenement INT DEFAULT NULL');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT FK_32528BB18B13D439 FOREIGN KEY (id_evenement) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE musique CHANGE id_listmusique id_listmusique INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY FK_D5CB977CFE8E41A');
        $this->addSql('ALTER TABLE Appartient DROP FOREIGN KEY FK_D5CB9773080FFCC');
        $this->addSql('ALTER TABLE Appartient CHANGE id_list id_list INT NOT NULL, CHANGE id_musique id_musique INT NOT NULL');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT list_number FOREIGN KEY (id_list) REFERENCES list_musique (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Appartient ADD CONSTRAINT musique_number FOREIGN KEY (id_musique) REFERENCES musique (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement ADD password VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY FK_32528BB18B13D439');
        $this->addSql('ALTER TABLE list_musique CHANGE id_evenement id_evenement INT NOT NULL');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT id_evenement FOREIGN KEY (id_evenement) REFERENCES evenement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE musique CHANGE id_listmusique id_listmusique INT NOT NULL');
    }
}
