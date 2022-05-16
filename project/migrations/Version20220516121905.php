<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516121905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, auteur VARCHAR(255) NOT NULL, note DOUBLE PRECISION NOT NULL, occasion VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY id_listmusique');
        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY id_musique');
        $this->addSql('ALTER TABLE appartient CHANGE id_list id_list INT DEFAULT NULL, CHANGE id_musique id_musique INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA7CFE8E41A FOREIGN KEY (id_list) REFERENCES list_musique (id)');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT FK_4201BAA73080FFCC FOREIGN KEY (id_musique) REFERENCES musique (id)');
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY id_evenement');
        $this->addSql('ALTER TABLE list_musique CHANGE id_evenement id_evenement INT DEFAULT NULL, CHANGE nom_list nom_list VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT FK_32528BB18B13D439 FOREIGN KEY (id_evenement) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE list_musique RENAME INDEX id_evenement TO IDX_32528BB18B13D439');
        $this->addSql('ALTER TABLE musique CHANGE titre titre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE avis');
        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY FK_4201BAA7CFE8E41A');
        $this->addSql('ALTER TABLE appartient DROP FOREIGN KEY FK_4201BAA73080FFCC');
        $this->addSql('ALTER TABLE appartient CHANGE id_list id_list INT NOT NULL, CHANGE id_musique id_musique INT NOT NULL');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT id_listmusique FOREIGN KEY (id_list) REFERENCES list_musique (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartient ADD CONSTRAINT id_musique FOREIGN KEY (id_musique) REFERENCES musique (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_musique DROP FOREIGN KEY FK_32528BB18B13D439');
        $this->addSql('ALTER TABLE list_musique CHANGE id_evenement id_evenement INT NOT NULL, CHANGE nom_list nom_list VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE list_musique ADD CONSTRAINT id_evenement FOREIGN KEY (id_evenement) REFERENCES evenement (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE list_musique RENAME INDEX idx_32528bb18b13d439 TO id_evenement');
        $this->addSql('ALTER TABLE musique CHANGE titre titre VARCHAR(180) NOT NULL');
    }
}
