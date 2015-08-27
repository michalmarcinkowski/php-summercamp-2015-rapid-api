<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150827014352 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Movie ADD genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Movie ADD CONSTRAINT FK_DC9FDD6B4296D31F FOREIGN KEY (genre_id) REFERENCES Genre (id)');
        $this->addSql('CREATE INDEX IDX_DC9FDD6B4296D31F ON Movie (genre_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Movie DROP FOREIGN KEY FK_DC9FDD6B4296D31F');
        $this->addSql('DROP INDEX IDX_DC9FDD6B4296D31F ON Movie');
        $this->addSql('ALTER TABLE Movie DROP genre_id');
    }
}
