<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214210802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE element_donnee (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element_donnee_valeur (id INT AUTO_INCREMENT NOT NULL, elementdonnee_id INT DEFAULT NULL, provences_id INT DEFAULT NULL, value INT DEFAULT NULL, datedata DATETIME DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, INDEX IDX_D989A2928121F760 (elementdonnee_id), INDEX IDX_D989A292263E46F5 (provences_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element_donnee_valeur ADD CONSTRAINT FK_D989A2928121F760 FOREIGN KEY (elementdonnee_id) REFERENCES element_donnee (id)');
        $this->addSql('ALTER TABLE element_donnee_valeur ADD CONSTRAINT FK_D989A292263E46F5 FOREIGN KEY (provences_id) REFERENCES provinces (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE element_donnee_valeur DROP FOREIGN KEY FK_D989A2928121F760');
        $this->addSql('ALTER TABLE element_donnee_valeur DROP FOREIGN KEY FK_D989A292263E46F5');
        $this->addSql('DROP TABLE element_donnee');
        $this->addSql('DROP TABLE element_donnee_valeur');
    }
}
