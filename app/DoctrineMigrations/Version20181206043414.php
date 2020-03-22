<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181206043414 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6727ACA70');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_category (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_category DROP FOREIGN KEY FK_72113DE6727ACA70');
        $this->addSql('ALTER TABLE blog_category ADD CONSTRAINT FK_72113DE6727ACA70 FOREIGN KEY (parent_id) REFERENCES blog_category (id) ON DELETE SET NULL');
    }
}
