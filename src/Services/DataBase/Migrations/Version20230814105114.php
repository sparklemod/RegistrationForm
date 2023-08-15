<?php

declare(strict_types=1);

namespace App\Services\DataBase\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230814105114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Books (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, year DATE NOT NULL, edition VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Users_Books (user_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_EA312E08A76ED395 (user_id), INDEX IDX_EA312E0816A2B381 (book_id), PRIMARY KEY(user_id, book_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Users_Books ADD CONSTRAINT FK_EA312E08A76ED395 FOREIGN KEY (user_id) REFERENCES Users (id)');
        $this->addSql('ALTER TABLE Users_Books ADD CONSTRAINT FK_EA312E0816A2B381 FOREIGN KEY (book_id) REFERENCES Books (id)');
        $this->addSql('DROP INDEX id ON Users');
        $this->addSql('ALTER TABLE Users CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE pass pass VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Users_Books DROP FOREIGN KEY FK_EA312E08A76ED395');
        $this->addSql('ALTER TABLE Users_Books DROP FOREIGN KEY FK_EA312E0816A2B381');
        $this->addSql('DROP TABLE Books');
        $this->addSql('DROP TABLE Users_Books');
        $this->addSql('ALTER TABLE Users MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE Users DROP INDEX primary, ADD UNIQUE INDEX id (id)');
        $this->addSql('ALTER TABLE Users CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE pass pass VARCHAR(50) NOT NULL');
    }
}
