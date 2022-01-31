<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131123610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bool_field (id INT AUTO_INCREMENT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data TINYINT(1) DEFAULT NULL, INDEX IDX_90906EAFD2A69B8B (owning_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date_field (id INT AUTO_INCREMENT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data DATE NOT NULL, INDEX IDX_E105ADD4D2A69B8B (owning_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, parent_collection_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_1F1B251E8DCF356F (parent_collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items_collection (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, string_property_name_1 VARCHAR(50) DEFAULT NULL, string_property_name_2 VARCHAR(50) DEFAULT NULL, string_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_1 VARCHAR(50) DEFAULT NULL, text_property_name_3 VARCHAR(50) DEFAULT NULL, text_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_1 VARCHAR(50) DEFAULT NULL, date_property_name_2 VARCHAR(50) DEFAULT NULL, date_property_name_3 VARCHAR(50) DEFAULT NULL, numeric_property_name_1 VARCHAR(50) DEFAULT NULL, numeric_property_name_2 VARCHAR(50) DEFAULT NULL, numeric_property_name_3 VARCHAR(50) DEFAULT NULL, bool_property_name_1 VARCHAR(50) DEFAULT NULL, bool_property_name_2 VARCHAR(50) DEFAULT NULL, bool_property_name_3 VARCHAR(50) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_62555B057E3C61F9 (owner_id), INDEX IDX_62555B0512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE numeric_field (id INT AUTO_INCREMENT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data DOUBLE PRECISION DEFAULT NULL, INDEX IDX_20A67C5FD2A69B8B (owning_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE string_field (id INT AUTO_INCREMENT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data VARCHAR(255) DEFAULT NULL, INDEX IDX_8FF91EC5D2A69B8B (owning_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_field (id INT AUTO_INCREMENT NOT NULL, owning_item_id INT NOT NULL, name VARCHAR(50) NOT NULL, data LONGTEXT DEFAULT NULL, INDEX IDX_D41FF05D2A69B8B (owning_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bool_field ADD CONSTRAINT FK_90906EAFD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE date_field ADD CONSTRAINT FK_E105ADD4D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E8DCF356F FOREIGN KEY (parent_collection_id) REFERENCES items_collection (id)');
        $this->addSql('ALTER TABLE items_collection ADD CONSTRAINT FK_62555B057E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE items_collection ADD CONSTRAINT FK_62555B0512469DE2 FOREIGN KEY (category_id) REFERENCES collection_category (id)');
        $this->addSql('ALTER TABLE numeric_field ADD CONSTRAINT FK_20A67C5FD2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE string_field ADD CONSTRAINT FK_8FF91EC5D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE text_field ADD CONSTRAINT FK_D41FF05D2A69B8B FOREIGN KEY (owning_item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_collection DROP FOREIGN KEY FK_62555B0512469DE2');
        $this->addSql('ALTER TABLE bool_field DROP FOREIGN KEY FK_90906EAFD2A69B8B');
        $this->addSql('ALTER TABLE date_field DROP FOREIGN KEY FK_E105ADD4D2A69B8B');
        $this->addSql('ALTER TABLE numeric_field DROP FOREIGN KEY FK_20A67C5FD2A69B8B');
        $this->addSql('ALTER TABLE string_field DROP FOREIGN KEY FK_8FF91EC5D2A69B8B');
        $this->addSql('ALTER TABLE text_field DROP FOREIGN KEY FK_D41FF05D2A69B8B');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E8DCF356F');
        $this->addSql('ALTER TABLE items_collection DROP FOREIGN KEY FK_62555B057E3C61F9');
        $this->addSql('DROP TABLE bool_field');
        $this->addSql('DROP TABLE collection_category');
        $this->addSql('DROP TABLE date_field');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE items_collection');
        $this->addSql('DROP TABLE numeric_field');
        $this->addSql('DROP TABLE string_field');
        $this->addSql('DROP TABLE text_field');
        $this->addSql('DROP TABLE user');
    }
}
