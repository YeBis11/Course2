<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131054645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA app');
        $this->addSql('CREATE SEQUENCE bool_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE collection_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE date_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE items_collection_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE numeric_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE string_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE text_field_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bool_field (id INT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_90906EAFD2A69B8B ON bool_field (owning_item_id)');
        $this->addSql('CREATE TABLE collection_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE date_field (id INT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E105ADD4D2A69B8B ON date_field (owning_item_id)');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, parent_collection_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F1B251E8DCF356F ON item (parent_collection_id)');
        $this->addSql('CREATE TABLE items_collection (id INT NOT NULL, owner_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, string_property_name_1 VARCHAR(50) DEFAULT NULL, string_property_name_2 VARCHAR(50) DEFAULT NULL, string_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_1 VARCHAR(50) DEFAULT NULL, text_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_1 VARCHAR(50) DEFAULT NULL, date_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_3 VARCHAR(50) DEFAULT NULL, numeric_property_name_1 VARCHAR(50) DEFAULT NULL, numeric_property_name_2 VARCHAR(50) DEFAULT NULL, numeric_property_name_3 VARCHAR(50) DEFAULT NULL, bool_property_name_1 VARCHAR(50) DEFAULT NULL, bool_property_name_2 VARCHAR(50) DEFAULT NULL, bool_property_name_3 VARCHAR(50) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62555B057E3C61F9 ON items_collection (owner_id)');
        $this->addSql('CREATE INDEX IDX_62555B0512469DE2 ON items_collection (category_id)');
        $this->addSql('CREATE TABLE numeric_field (id INT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_20A67C5FD2A69B8B ON numeric_field (owning_item_id)');
        $this->addSql('CREATE TABLE string_field (id INT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8FF91EC5D2A69B8B ON string_field (owning_item_id)');
        $this->addSql('CREATE TABLE text_field (id INT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D41FF05D2A69B8B ON text_field (owning_item_id)');
        $this->addSql('CREATE TABLE app."user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C0F3A96E7927C74 ON app."user" (email)');
        $this->addSql('ALTER TABLE bool_field ADD CONSTRAINT FK_90906EAFD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE date_field ADD CONSTRAINT FK_E105ADD4D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E8DCF356F FOREIGN KEY (parent_collection_id) REFERENCES items_collection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_collection ADD CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES app."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE items_collection ADD CONSTRAINT FK_62555B0512469DE2 FOREIGN KEY (category_id) REFERENCES collection_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE numeric_field ADD CONSTRAINT FK_20A67C5FD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE string_field ADD CONSTRAINT FK_8FF91EC5D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE text_field ADD CONSTRAINT FK_D41FF05D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE items_collection DROP CONSTRAINT FK_62555B0512469DE2');
        $this->addSql('ALTER TABLE bool_field DROP CONSTRAINT FK_90906EAFD2A69B8B');
        $this->addSql('ALTER TABLE date_field DROP CONSTRAINT FK_E105ADD4D2A69B8B');
        $this->addSql('ALTER TABLE numeric_field DROP CONSTRAINT FK_20A67C5FD2A69B8B');
        $this->addSql('ALTER TABLE string_field DROP CONSTRAINT FK_8FF91EC5D2A69B8B');
        $this->addSql('ALTER TABLE text_field DROP CONSTRAINT FK_D41FF05D2A69B8B');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251E8DCF356F');
        $this->addSql('ALTER TABLE items_collection DROP CONSTRAINT FK_62555B057E3C61F9');
        $this->addSql('DROP SEQUENCE bool_field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE collection_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE date_field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE items_collection_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE numeric_field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE string_field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE text_field_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app.user_id_seq CASCADE');
        $this->addSql('DROP TABLE bool_field');
        $this->addSql('DROP TABLE collection_category');
        $this->addSql('DROP TABLE date_field');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('DROP TABLE numeric_field');
        $this->addSql('DROP TABLE string_field');
        $this->addSql('DROP TABLE text_field');
        $this->addSql('DROP TABLE app."user"');
    }
}
