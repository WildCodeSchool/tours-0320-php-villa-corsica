<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200702125537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE villa (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location LONGTEXT NOT NULL, description LONGTEXT NOT NULL, nb_room INT NOT NULL, nb_bed INT NOT NULL, nb_bathroom INT NOT NULL, capacity INT NOT NULL, sqm INT NOT NULL, price_from INT NOT NULL, poster LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE golden_book (id INT AUTO_INCREMENT NOT NULL, villa_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, departure_date DATE NOT NULL, commentary VARCHAR(400) NOT NULL, INDEX IDX_67E09804285D9761 (villa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, villa_id INT DEFAULT NULL, photo LONGTEXT NOT NULL, INDEX IDX_16DB4F89285D9761 (villa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE golden_book ADD CONSTRAINT FK_67E09804285D9761 FOREIGN KEY (villa_id) REFERENCES villa (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89285D9761 FOREIGN KEY (villa_id) REFERENCES villa (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE golden_book DROP FOREIGN KEY FK_67E09804285D9761');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89285D9761');
        $this->addSql('DROP TABLE villa');
        $this->addSql('DROP TABLE golden_book');
        $this->addSql('DROP TABLE picture');
    }
}
