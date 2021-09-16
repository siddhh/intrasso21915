<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726133206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_genre (article_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(article_id, genre_id))');
        $this->addSql('CREATE INDEX IDX_F4E741E97294869C ON article_genre (article_id)');
        $this->addSql('CREATE INDEX IDX_F4E741E94296D31F ON article_genre (genre_id)');
        $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E94296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE article_genre');
    }
}
