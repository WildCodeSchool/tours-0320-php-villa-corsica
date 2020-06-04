<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604080432 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre_dor ADD villa_id INT NOT NULL, ADD date_arrival DATE NOT NULL, DROP villa_name, DROP month_stay, DROP year_stay');
        $this->addSql('ALTER TABLE livre_dor ADD CONSTRAINT FK_8BA47718285D9761 FOREIGN KEY (villa_id) REFERENCES villa (id)');
        $this->addSql('CREATE INDEX IDX_8BA47718285D9761 ON livre_dor (villa_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livre_dor DROP FOREIGN KEY FK_8BA47718285D9761');
        $this->addSql('DROP INDEX IDX_8BA47718285D9761 ON livre_dor');
        $this->addSql('ALTER TABLE livre_dor ADD villa_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD year_stay DATE NOT NULL, DROP villa_id, CHANGE date_arrival month_stay DATE NOT NULL');
    }
}
