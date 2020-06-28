<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200616182641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE golden_book ADD villa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE golden_book ADD CONSTRAINT FK_67E09804285D9761 FOREIGN KEY (villa_id) REFERENCES villa (id)');
        $this->addSql('CREATE INDEX IDX_67E09804285D9761 ON golden_book (villa_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE golden_book DROP FOREIGN KEY FK_67E09804285D9761');
        $this->addSql('DROP INDEX IDX_67E09804285D9761 ON golden_book');
        $this->addSql('ALTER TABLE golden_book DROP villa_id');
    }
}
