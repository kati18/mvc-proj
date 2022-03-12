<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220306170009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guess_record ADD COLUMN date VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__guess_record AS SELECT id, name, number, tries FROM guess_record');
        $this->addSql('DROP TABLE guess_record');
        $this->addSql('CREATE TABLE guess_record (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(200) NOT NULL, number INTEGER NOT NULL, tries INTEGER NOT NULL)');
        $this->addSql('INSERT INTO guess_record (id, name, number, tries) SELECT id, name, number, tries FROM __temp__guess_record');
        $this->addSql('DROP TABLE __temp__guess_record');
    }
}
