<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729093755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre_nature (genre_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(genre_id, nature_id))');
        $this->addSql('CREATE INDEX IDX_5A6BB2874296D31F ON genre_nature (genre_id)');
        $this->addSql('CREATE INDEX IDX_5A6BB2873BCB2E4B ON genre_nature (nature_id)');
        $this->addSql('CREATE TABLE nature_genre (nature_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(nature_id, genre_id))');
        $this->addSql('CREATE INDEX IDX_E12B18913BCB2E4B ON nature_genre (nature_id)');
        $this->addSql('CREATE INDEX IDX_E12B18914296D31F ON nature_genre (genre_id)');
        $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2873BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18913BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18914296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE genre_nature');
        $this->addSql('DROP TABLE nature_genre');
    }
}
