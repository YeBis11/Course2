<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126153207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE lolit');
        $this->addSql('DROP INDEX IDX_90906EAFD2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__bool_field AS SELECT id, owning_item_id, name, data FROM bool_field');
        $this->addSql('DROP TABLE bool_field');
        $this->addSql('CREATE TABLE bool_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, data BOOLEAN DEFAULT NULL, CONSTRAINT FK_90906EAFD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO bool_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__bool_field');
        $this->addSql('DROP TABLE __temp__bool_field');
        $this->addSql('CREATE INDEX IDX_90906EAFD2A69B8B ON bool_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_E105ADD4D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__date_field AS SELECT id, owning_item_id, name, data FROM date_field');
        $this->addSql('DROP TABLE date_field');
        $this->addSql('CREATE TABLE date_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, data DATE NOT NULL, CONSTRAINT FK_E105ADD4D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO date_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__date_field');
        $this->addSql('DROP TABLE __temp__date_field');
        $this->addSql('CREATE INDEX IDX_E105ADD4D2A69B8B ON date_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_1F1B251E8DCF356F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, parent_collection_id, name, created_at, updated_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_collection_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_1F1B251E8DCF356F FOREIGN KEY (parent_collection_id) REFERENCES items_collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, parent_collection_id, name, created_at, updated_at) SELECT id, parent_collection_id, name, created_at, updated_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251E8DCF356F ON item (parent_collection_id)');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('DROP INDEX IDX_62555B0512469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, category_id, name, description, created_at, updated_at, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3 FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, string_property_name_1 VARCHAR(50) DEFAULT NULL COLLATE BINARY, string_property_name_2 VARCHAR(50) DEFAULT NULL COLLATE BINARY, string_property_name_3 VARCHAR(50) DEFAULT NULL COLLATE BINARY, text_property_name_1 VARCHAR(50) DEFAULT NULL COLLATE BINARY, text_property_name_3 VARCHAR(50) DEFAULT NULL COLLATE BINARY, text_property_name_2 VARCHAR(50) DEFAULT NULL COLLATE BINARY, date_property_name_1 VARCHAR(50) DEFAULT NULL COLLATE BINARY, date_property_name_2 VARCHAR(50) DEFAULT NULL COLLATE BINARY, date_property_name_3 VARCHAR(50) DEFAULT NULL COLLATE BINARY, numeric_property_name_1 VARCHAR(50) DEFAULT NULL COLLATE BINARY, numeric_property_name_2 VARCHAR(50) DEFAULT NULL COLLATE BINARY, numeric_property_name_3 VARCHAR(50) DEFAULT NULL COLLATE BINARY, bool_property_name_1 VARCHAR(50) DEFAULT NULL COLLATE BINARY, bool_property_name_2 VARCHAR(50) DEFAULT NULL COLLATE BINARY, bool_property_name_3 VARCHAR(50) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_62555B0512469DE2 FOREIGN KEY (category_id) REFERENCES collection_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, category_id, name, description, created_at, updated_at, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3) SELECT id, owner_id, category_id, name, description, created_at, updated_at, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3 FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
        $this->addSql('CREATE INDEX IDX_62555B0512469DE2 ON items_collection (category_id)');
        $this->addSql('DROP INDEX IDX_20A67C5FD2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__numeric_field AS SELECT id, owning_item_id, name, data FROM numeric_field');
        $this->addSql('DROP TABLE numeric_field');
        $this->addSql('CREATE TABLE numeric_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, data DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_20A67C5FD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO numeric_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__numeric_field');
        $this->addSql('DROP TABLE __temp__numeric_field');
        $this->addSql('CREATE INDEX IDX_20A67C5FD2A69B8B ON numeric_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_8FF91EC5D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__string_field AS SELECT id, owning_item_id, name, data FROM string_field');
        $this->addSql('DROP TABLE string_field');
        $this->addSql('CREATE TABLE string_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, data VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_8FF91EC5D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO string_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__string_field');
        $this->addSql('DROP TABLE __temp__string_field');
        $this->addSql('CREATE INDEX IDX_8FF91EC5D2A69B8B ON string_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_D41FF05D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__text_field AS SELECT id, owning_item_id, name, data FROM text_field');
        $this->addSql('DROP TABLE text_field');
        $this->addSql('CREATE TABLE text_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, data CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_D41FF05D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO text_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__text_field');
        $this->addSql('DROP TABLE __temp__text_field');
        $this->addSql('CREATE INDEX IDX_D41FF05D2A69B8B ON text_field (owning_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lolit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('DROP INDEX IDX_90906EAFD2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__bool_field AS SELECT id, owning_item_id, name, data FROM bool_field');
        $this->addSql('DROP TABLE bool_field');
        $this->addSql('CREATE TABLE bool_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO bool_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__bool_field');
        $this->addSql('DROP TABLE __temp__bool_field');
        $this->addSql('CREATE INDEX IDX_90906EAFD2A69B8B ON bool_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_E105ADD4D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__date_field AS SELECT id, owning_item_id, name, data FROM date_field');
        $this->addSql('DROP TABLE date_field');
        $this->addSql('CREATE TABLE date_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data DATE NOT NULL)');
        $this->addSql('INSERT INTO date_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__date_field');
        $this->addSql('DROP TABLE __temp__date_field');
        $this->addSql('CREATE INDEX IDX_E105ADD4D2A69B8B ON date_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_1F1B251E8DCF356F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, parent_collection_id, name, created_at, updated_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_collection_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO item (id, parent_collection_id, name, created_at, updated_at) SELECT id, parent_collection_id, name, created_at, updated_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251E8DCF356F ON item (parent_collection_id)');
        $this->addSql('DROP INDEX IDX_62555B057E3C61F9');
        $this->addSql('DROP INDEX IDX_62555B0512469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__items_collection AS SELECT id, owner_id, category_id, name, description, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3, created_at, updated_at FROM items_collection');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('CREATE TABLE items_collection (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, string_property_name_1 VARCHAR(50) DEFAULT NULL, string_property_name_2 VARCHAR(50) DEFAULT NULL, string_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_1 VARCHAR(50) DEFAULT NULL, text_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_1 VARCHAR(50) DEFAULT NULL, date_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_3 VARCHAR(50) DEFAULT NULL, numeric_property_name_1 VARCHAR(50) DEFAULT NULL, numeric_property_name_2 VARCHAR(50) DEFAULT NULL, numeric_property_name_3 VARCHAR(50) DEFAULT NULL, bool_property_name_1 VARCHAR(50) DEFAULT NULL, bool_property_name_2 VARCHAR(50) DEFAULT NULL, bool_property_name_3 VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO items_collection (id, owner_id, category_id, name, description, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3, created_at, updated_at) SELECT id, owner_id, category_id, name, description, string_property_name_1, string_property_name_2, string_property_name_3, text_property_name_1, text_property_name_3, text_property_name_2, date_property_name_1, date_property_name_2, date_property_name_3, numeric_property_name_1, numeric_property_name_2, numeric_property_name_3, bool_property_name_1, bool_property_name_2, bool_property_name_3, created_at, updated_at FROM __temp__items_collection');
        $this->addSql('DROP TABLE __temp__items_collection');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
        $this->addSql('CREATE INDEX IDX_62555B0512469DE2 ON items_collection (category_id)');
        $this->addSql('DROP INDEX IDX_20A67C5FD2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__numeric_field AS SELECT id, owning_item_id, name, data FROM numeric_field');
        $this->addSql('DROP TABLE numeric_field');
        $this->addSql('CREATE TABLE numeric_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data DOUBLE PRECISION DEFAULT NULL)');
        $this->addSql('INSERT INTO numeric_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__numeric_field');
        $this->addSql('DROP TABLE __temp__numeric_field');
        $this->addSql('CREATE INDEX IDX_20A67C5FD2A69B8B ON numeric_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_8FF91EC5D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__string_field AS SELECT id, owning_item_id, name, data FROM string_field');
        $this->addSql('DROP TABLE string_field');
        $this->addSql('CREATE TABLE string_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO string_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__string_field');
        $this->addSql('DROP TABLE __temp__string_field');
        $this->addSql('CREATE INDEX IDX_8FF91EC5D2A69B8B ON string_field (owning_item_id)');
        $this->addSql('DROP INDEX IDX_D41FF05D2A69B8B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__text_field AS SELECT id, owning_item_id, name, data FROM text_field');
        $this->addSql('DROP TABLE text_field');
        $this->addSql('CREATE TABLE text_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owning_item_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, data CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO text_field (id, owning_item_id, name, data) SELECT id, owning_item_id, name, data FROM __temp__text_field');
        $this->addSql('DROP TABLE __temp__text_field');
        $this->addSql('CREATE INDEX IDX_D41FF05D2A69B8B ON text_field (owning_item_id)');
    }
}
