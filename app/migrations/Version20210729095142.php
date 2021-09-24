<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729095142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE genre_nature');
        $this->addSql('DROP TABLE nature_genre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE genre_nature (genre_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(genre_id, nature_id))');
        $this->addSql('CREATE INDEX idx_5a6bb2874296d31f ON genre_nature (genre_id)');
        $this->addSql('CREATE INDEX idx_5a6bb2873bcb2e4b ON genre_nature (nature_id)');
        $this->addSql('CREATE TABLE nature_genre (nature_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(nature_id, genre_id))');
        $this->addSql('CREATE INDEX idx_e12b18913bcb2e4b ON nature_genre (nature_id)');
        $this->addSql('CREATE INDEX idx_e12b18914296d31f ON nature_genre (genre_id)');
        $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT fk_5a6bb2874296d31f FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT fk_5a6bb2873bcb2e4b FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT fk_e12b18913bcb2e4b FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT fk_e12b18914296d31f FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE categorie');
    }
}
