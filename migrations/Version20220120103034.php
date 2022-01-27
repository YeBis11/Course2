<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120103034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, name, description FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, name, description) SELECT id, owner_id, name, description FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, name FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO item (id, name) SELECT id, name FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, name, description FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, name, description) SELECT id, owner_id, name, description FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
    }
}
