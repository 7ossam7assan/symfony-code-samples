<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181206025952 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pagess (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_keywords LONGTEXT DEFAULT NULL, INDEX IDX_3B413E5D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pagess ADD CONSTRAINT FK_3B413E5D12469DE2 FOREIGN KEY (category_id) REFERENCES pages_category (id)');
        $this->addSql('DROP TABLE pages');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, content LONGTEXT NOT NULL COLLATE utf8_unicode_ci, slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, meta_title VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, meta_description LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, meta_keywords LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, photo VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX IDX_2074E57512469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E57512469DE2 FOREIGN KEY (category_id) REFERENCES pages_category (id)');
        $this->addSql('DROP TABLE pagess');
    }
}
