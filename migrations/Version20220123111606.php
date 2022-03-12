<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220123111606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE high_score ADD COLUMN histogramp VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE high_score ADD COLUMN histogramc VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__high_score AS SELECT id, winner, score, date FROM high_score');
        $this->addSql('DROP TABLE high_score');
        $this->addSql('CREATE TABLE high_score (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, winner VARCHAR(30) NOT NULL, score INTEGER NOT NULL, date VARCHAR(50) NOT NULL)');
        $this->addSql('INSERT INTO high_score (id, winner, score, date) SELECT id, winner, score, date FROM __temp__high_score');
        $this->addSql('DROP TABLE __temp__high_score');
    }
}
