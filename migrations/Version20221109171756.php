<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109171756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education ADD nbrefe INT DEFAULT NULL, ADD nbreh INT DEFAULT NULL, DROP nbre_fe, DROP nbre_h');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education ADD nbre_fe INT DEFAULT NULL, ADD nbre_h INT DEFAULT NULL, DROP nbrefe, DROP nbreh');
    }
}
