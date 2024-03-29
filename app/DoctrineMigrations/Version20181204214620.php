<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181204214620 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog CHANGE num_of_views num_of_views INT NOT NULL');
        $this->addSql('ALTER TABLE blog_category ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_category (id)');
        $this->addSql('CREATE INDEX IDX_72113DE6727ACA70 ON blog_category (parent_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog CHANGE num_of_views num_of_views INT NOT NULL');
        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6727ACA70');
        $this->addSql('DROP INDEX IDX_72113DE6727ACA70 ON blog_category');
        $this->addSql('ALTER TABLE blog_category DROP parent_id');
    }
}
