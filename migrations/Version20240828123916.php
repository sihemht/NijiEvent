<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828123916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__books AS SELECT id, title, saga, number, number_of_page, month_of_purchase, used_id, genres, rating, authors, genres_text, reading_status FROM books');
        $this->addSql('DROP TABLE books');
        $this->addSql('CREATE TABLE books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, saga VARCHAR(255) DEFAULT NULL, number INTEGER DEFAULT NULL, number_of_page INTEGER DEFAULT NULL, month_of_purchase DATE DEFAULT NULL, used_id INTEGER DEFAULT NULL, genres CLOB DEFAULT NULL --(DC2Type:json)
        , rating INTEGER DEFAULT NULL, authors CLOB DEFAULT NULL --(DC2Type:json)
        , genres_text VARCHAR(255) DEFAULT NULL, reading_status VARCHAR(255) NOT NULL, image_cover VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO books (id, title, saga, number, number_of_page, month_of_purchase, used_id, genres, rating, authors, genres_text, reading_status) SELECT id, title, saga, number, number_of_page, month_of_purchase, used_id, genres, rating, authors, genres_text, reading_status FROM __temp__books');
        $this->addSql('DROP TABLE __temp__books');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__books AS SELECT id, title, saga, number, number_of_page, month_of_purchase, used_id, rating, authors, genres_text, genres, reading_status FROM books');
        $this->addSql('DROP TABLE books');
        $this->addSql('CREATE TABLE books (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, saga VARCHAR(255) DEFAULT NULL, number INTEGER DEFAULT NULL, number_of_page INTEGER DEFAULT NULL, month_of_purchase DATE DEFAULT NULL, used_id INTEGER DEFAULT NULL, rating INTEGER DEFAULT NULL, authors CLOB DEFAULT NULL --(DC2Type:json)
        , genres_text VARCHAR(255) DEFAULT NULL, genres CLOB DEFAULT NULL --(DC2Type:json)
        , reading_status VARCHAR(255) DEFAULT \'to_read\' NOT NULL)');
        $this->addSql('INSERT INTO books (id, title, saga, number, number_of_page, month_of_purchase, used_id, rating, authors, genres_text, genres, reading_status) SELECT id, title, saga, number, number_of_page, month_of_purchase, used_id, rating, authors, genres_text, genres, reading_status FROM __temp__books');
        $this->addSql('DROP TABLE __temp__books');
    }
}
