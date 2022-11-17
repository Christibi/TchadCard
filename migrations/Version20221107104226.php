<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107104226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE provinces (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE education ADD niveau_id INT DEFAULT NULL, ADD indicateur_id INT DEFAULT NULL, ADD province_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2DA3B8F3D FOREIGN KEY (indicateur_id) REFERENCES indicateur (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2E946114A FOREIGN KEY (province_id) REFERENCES provinces (id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2B3E9C81 ON education (niveau_id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2DA3B8F3D ON education (indicateur_id)');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2E946114A ON education (province_id)');
        $this->addSql('ALTER TABLE indicateur ADD commission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE indicateur ADD CONSTRAINT FK_7C663A27202D1EB2 FOREIGN KEY (commission_id) REFERENCES commission (id)');
        $this->addSql('CREATE INDEX IDX_7C663A27202D1EB2 ON indicateur (commission_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2E946114A');
        $this->addSql('DROP TABLE provinces');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2B3E9C81');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2DA3B8F3D');
        $this->addSql('DROP INDEX IDX_DB0A5ED2B3E9C81 ON education');
        $this->addSql('DROP INDEX IDX_DB0A5ED2DA3B8F3D ON education');
        $this->addSql('DROP INDEX IDX_DB0A5ED2E946114A ON education');
        $this->addSql('ALTER TABLE education DROP niveau_id, DROP indicateur_id, DROP province_id');
        $this->addSql('ALTER TABLE indicateur DROP FOREIGN KEY FK_7C663A27202D1EB2');
        $this->addSql('DROP INDEX IDX_7C663A27202D1EB2 ON indicateur');
        $this->addSql('ALTER TABLE indicateur DROP commission_id');
    }
}
