<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109225307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_vulnerabilite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tranche_age (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE education ADD status_id INT DEFAULT NULL, ADD categorie_vulnerabilite_id INT DEFAULT NULL, ADD trange_age_id INT DEFAULT NULL, ADD milieu VARCHAR(255) DEFAULT NULL, ADD langue VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED26BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED259F58035 FOREIGN KEY (categorie_vulnerabilite_id) REFERENCES categorie_vulnerabilite (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2EBEA859D FOREIGN KEY (trange_age_id) REFERENCES tranche_age (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED26BF700BD ON education (status_id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED259F58035 ON education (categorie_vulnerabilite_id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2EBEA859D ON education (trange_age_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED259F58035');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED26BF700BD');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2EBEA859D');
        $this->addSql('DROP TABLE categorie_vulnerabilite');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tranche_age');
        $this->addSql('DROP INDEX IDX_DB0A5ED26BF700BD ON education');
        $this->addSql('DROP INDEX IDX_DB0A5ED259F58035 ON education');
        $this->addSql('DROP INDEX IDX_DB0A5ED2EBEA859D ON education');
        $this->addSql('ALTER TABLE education DROP status_id, DROP categorie_vulnerabilite_id, DROP trange_age_id, DROP milieu, DROP langue');
    }
}
