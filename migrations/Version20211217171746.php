<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217171746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens_immobiliers CHANGE a_vendre a_vendre TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE a_louer a_louer TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biens_immobiliers CHANGE a_vendre a_vendre TINYINT(1) NOT NULL, CHANGE a_louer a_louer TINYINT(1) NOT NULL');
    }
}
