<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181213051421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, job_title VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT \'default_team.jpg\' NOT NULL, phone VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, fb_link LONGTEXT DEFAULT NULL, youtube_link LONGTEXT DEFAULT NULL, twitter_link LONGTEXT DEFAULT NULL, skype_link LONGTEXT DEFAULT NULL, instagram_link LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, meta_title LONGTEXT DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_keywords LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE team');
    }
}
