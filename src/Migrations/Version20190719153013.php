<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719153013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dish ADD dish_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8E7A8582C FOREIGN KEY (dish_group_id) REFERENCES dish_group (id)');
        $this->addSql('CREATE INDEX IDX_957D8CB8E7A8582C ON dish (dish_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8E7A8582C');
        $this->addSql('DROP INDEX IDX_957D8CB8E7A8582C ON dish');
        $this->addSql('ALTER TABLE dish DROP dish_group_id');
    }
}
