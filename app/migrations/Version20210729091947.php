<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729091947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE article_genre (article_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(article_id, genre_id))');
        //$this->addSql('CREATE INDEX IDX_F4E741E97294869C ON article_genre (article_id)');
        //$this->addSql('CREATE INDEX IDX_F4E741E94296D31F ON article_genre (genre_id)');
        // $this->addSql('CREATE TABLE liste_objets (id INT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE nature_genre (nature_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(nature_id, genre_id))');
        // $this->addSql('CREATE INDEX IDX_E12B18913BCB2E4B ON nature_genre (nature_id)');
        // $this->addSql('CREATE INDEX IDX_E12B18914296D31F ON nature_genre (genre_id)');
        // $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E94296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18913BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18914296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('DROP TABLE nature_nature');
        // $this->addSql('DROP TABLE article_categorie');
        // $this->addSql('ALTER TABLE article DROP image');
        // $this->addSql('ALTER TABLE categorie DROP label');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE nature_nature (nature_source INT NOT NULL, nature_target INT NOT NULL, PRIMARY KEY(nature_source, nature_target))');
        $this->addSql('CREATE INDEX idx_85d4207072638d2b ON nature_nature (nature_target)');
        $this->addSql('CREATE INDEX idx_85d420706b86dda4 ON nature_nature (nature_source)');
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY(article_id, categorie_id))');
        $this->addSql('CREATE INDEX idx_93488610bcf5e72d ON article_categorie (categorie_id)');
        $this->addSql('CREATE INDEX idx_934886107294869c ON article_categorie (article_id)');
        $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT fk_85d420706b86dda4 FOREIGN KEY (nature_source) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT fk_85d4207072638d2b FOREIGN KEY (nature_target) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT fk_934886107294869c FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT fk_93488610bcf5e72d FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE article_genre');
        $this->addSql('DROP TABLE liste_objets');
        $this->addSql('DROP TABLE nature_genre');
        $this->addSql('ALTER TABLE categorie ADD label VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE article ADD image VARCHAR(255) NOT NULL');
    }
}
