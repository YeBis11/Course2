<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125133016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE string_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_8FF91EC5D2A69B8B ON string_field (owning_item_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, name, created_at, updated_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_collection_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_1F1B251E8DCF356F FOREIGN KEY (parent_collection_id) REFERENCES items_collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, name, created_at, updated_at) SELECT id, name, created_at, updated_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251E8DCF356F ON item (parent_collection_id)');
        $this->addSql('DROP INDEX IDX_62555B0512469DE2');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, category_id, name, description, created_at, updated_at FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, string_property_name_1 VARCHAR(50) DEFAULT NULL, string_property_name_2 VARCHAR(50) DEFAULT NULL, string_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_1 VARCHAR(50) DEFAULT NULL, text_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_1 VARCHAR(50) DEFAULT NULL, date_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_3 VARCHAR(50) DEFAULT NULL, numeric_property_name_1 VARCHAR(50) DEFAULT NULL, numeric_property_name_2 VARCHAR(50) DEFAULT NULL, numeric_property_name_3 VARCHAR(50) DEFAULT NULL, bool_property_name_1 VARCHAR(50) DEFAULT NULL, bool_property_name_2 VARCHAR(50) DEFAULT NULL, bool_property_name_3 VARCHAR(50) DEFAULT NULL, CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_62555B0512469DE2 FOREIGN KEY (category_id) REFERENCES collection_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, category_id, name, description, created_at, updated_at) SELECT id, owner_id, category_id, name, description, created_at, updated_at FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B0512469DE2 ON items_collection (category_id)');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE string_field');
        $this->addSql('DROP INDEX IDX_1F1B251E8DCF356F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, name, created_at, updated_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO item (id, name, created_at, updated_at) SELECT id, name, created_at, updated_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('DROP INDEX IDX_62555B0512469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, category_id, name, description, created_at, updated_at FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, category_id, name, description, created_at, updated_at) SELECT id, owner_id, category_id, name, description, created_at, updated_at FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
        $this->addSql('CREATE INDEX IDX_62555B0512469DE2 ON items_collection (category_id)');
    }
}
