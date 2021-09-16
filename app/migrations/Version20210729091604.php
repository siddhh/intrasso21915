<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210729091604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE auteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE invite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE langage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE liste_objets_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE nature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE user1_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE TABLE admin (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON admin (email)');
        // $this->addSql('CREATE TABLE article (id INT NOT NULL, proprietaire_id INT NOT NULL, emprunteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description BYTEA NOT NULL, est_emprunte BOOLEAN DEFAULT NULL, date_suppression TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, genres TEXT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE INDEX IDX_23A0E6676C50E4A ON article (proprietaire_id)');
        // $this->addSql('CREATE INDEX IDX_23A0E66F0840037 ON article (emprunteur_id)');
        // $this->addSql('COMMENT ON COLUMN article.genres IS \'(DC2Type:array)\'');
        // $this->addSql('CREATE TABLE article_langage (article_id INT NOT NULL, langage_id INT NOT NULL, PRIMARY KEY(article_id, langage_id))');
        // $this->addSql('CREATE INDEX IDX_2182AE917294869C ON article_langage (article_id)');
        // $this->addSql('CREATE INDEX IDX_2182AE91957BB53C ON article_langage (langage_id)');
        // $this->addSql('CREATE TABLE article_nature (article_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(article_id, nature_id))');
        // $this->addSql('CREATE INDEX IDX_DB1F15277294869C ON article_nature (article_id)');
        // $this->addSql('CREATE INDEX IDX_DB1F15273BCB2E4B ON article_nature (nature_id)');
        // $this->addSql('CREATE TABLE article_auteur (article_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY(article_id, auteur_id))');
        // $this->addSql('CREATE INDEX IDX_6F9D26C07294869C ON article_auteur (article_id)');
        // $this->addSql('CREATE INDEX IDX_6F9D26C060BB6FE6 ON article_auteur (auteur_id)');
        // $this->addSql('CREATE TABLE article_genre (article_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(article_id, genre_id))');
        // $this->addSql('CREATE INDEX IDX_F4E741E97294869C ON article_genre (article_id)');
        // $this->addSql('CREATE INDEX IDX_F4E741E94296D31F ON article_genre (genre_id)');
        // $this->addSql('CREATE TABLE auteur (id INT NOT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE categorie (id INT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE genre (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE genre_nature (genre_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(genre_id, nature_id))');
        // $this->addSql('CREATE INDEX IDX_5A6BB2874296D31F ON genre_nature (genre_id)');
        // $this->addSql('CREATE INDEX IDX_5A6BB2873BCB2E4B ON genre_nature (nature_id)');
        // $this->addSql('CREATE TABLE invite (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_C7E210D7E7927C74 ON invite (email)');
        // $this->addSql('CREATE TABLE langage (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE liste_objets (id INT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE nature (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE nature_genre (nature_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(nature_id, genre_id))');
        // $this->addSql('CREATE INDEX IDX_E12B18913BCB2E4B ON nature_genre (nature_id)');
        // $this->addSql('CREATE INDEX IDX_E12B18914296D31F ON nature_genre (genre_id)');
        // $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN DEFAULT \'false\' NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, actif BOOLEAN DEFAULT \'false\' NOT NULL, nbr_emprunt_possible INT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        // $this->addSql('CREATE TABLE user1 (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_8C518555E7927C74 ON user1 (email)');
        // $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        // $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6676C50E4A FOREIGN KEY (proprietaire_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F0840037 FOREIGN KEY (emprunteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_langage ADD CONSTRAINT FK_2182AE917294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_langage ADD CONSTRAINT FK_2182AE91957BB53C FOREIGN KEY (langage_id) REFERENCES langage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_nature ADD CONSTRAINT FK_DB1F15277294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_nature ADD CONSTRAINT FK_DB1F15273BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_genre ADD CONSTRAINT FK_F4E741E94296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2873BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18913BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_genre ADD CONSTRAINT FK_E12B18914296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article_langage DROP CONSTRAINT FK_2182AE917294869C');
        $this->addSql('ALTER TABLE article_nature DROP CONSTRAINT FK_DB1F15277294869C');
        $this->addSql('ALTER TABLE article_auteur DROP CONSTRAINT FK_6F9D26C07294869C');
        $this->addSql('ALTER TABLE article_genre DROP CONSTRAINT FK_F4E741E97294869C');
        $this->addSql('ALTER TABLE article_auteur DROP CONSTRAINT FK_6F9D26C060BB6FE6');
        $this->addSql('ALTER TABLE article_genre DROP CONSTRAINT FK_F4E741E94296D31F');
        $this->addSql('ALTER TABLE genre_nature DROP CONSTRAINT FK_5A6BB2874296D31F');
        $this->addSql('ALTER TABLE nature_genre DROP CONSTRAINT FK_E12B18914296D31F');
        $this->addSql('ALTER TABLE article_langage DROP CONSTRAINT FK_2182AE91957BB53C');
        $this->addSql('ALTER TABLE article_nature DROP CONSTRAINT FK_DB1F15273BCB2E4B');
        $this->addSql('ALTER TABLE genre_nature DROP CONSTRAINT FK_5A6BB2873BCB2E4B');
        $this->addSql('ALTER TABLE nature_genre DROP CONSTRAINT FK_E12B18913BCB2E4B');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E6676C50E4A');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66F0840037');
        $this->addSql('DROP SEQUENCE admin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE auteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE invite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE langage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE liste_objets_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        //$this->addSql('DROP SEQUENCE user1_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_langage');
        $this->addSql('DROP TABLE article_nature');
        $this->addSql('DROP TABLE article_auteur');
        $this->addSql('DROP TABLE article_genre');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_nature');
        $this->addSql('DROP TABLE invite');
        $this->addSql('DROP TABLE langage');
        $this->addSql('DROP TABLE liste_objets');
        $this->addSql('DROP TABLE nature');
        $this->addSql('DROP TABLE nature_genre');
        $this->addSql('DROP TABLE "user"');
        //$this->addSql('DROP TABLE user1');
        $this->addSql('DROP TABLE users');
    }
}
