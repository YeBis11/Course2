<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120120609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collection_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name_id INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F7CCD7F171179CD6 ON collection_category (name_id)');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, name, description, created_at, updated_at FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, name, description, created_at, updated_at) SELECT id, owner_id, name, description, created_at, updated_at FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE collection_category');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, name, description, created_at, updated_at FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, name, description, created_at, updated_at) SELECT id, owner_id, name, description, created_at, updated_at FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
    }
}
