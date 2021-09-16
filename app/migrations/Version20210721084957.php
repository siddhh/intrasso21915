<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721084957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE admin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE SEQUENCE auteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE invite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE langage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE liste_objets_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE nature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE user1_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        // $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE TABLE admin (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON admin (email)');
        //$this->addSql('CREATE TABLE article (id INT NOT NULL, proprietaire_id INT NOT NULL, emprunteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description BYTEA NOT NULL, est_emprunte BOOLEAN DEFAULT NULL, date_suppression TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, image VARCHAR(255) NOT NULL, genres TEXT NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE INDEX IDX_23A0E6676C50E4A ON article (proprietaire_id)');
        // $this->addSql('CREATE INDEX IDX_23A0E66F0840037 ON article (emprunteur_id)');
        // $this->addSql('COMMENT ON COLUMN article.genres IS \'(DC2Type:array)\'');
        // $this->addSql('CREATE TABLE article_langage (article_id INT NOT NULL, langage_id INT NOT NULL, PRIMARY KEY(article_id, langage_id))');
        // $this->addSql('CREATE INDEX IDX_2182AE917294869C ON article_langage (article_id)');
        // $this->addSql('CREATE INDEX IDX_2182AE91957BB53C ON article_langage (langage_id)');
        // $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY(article_id, categorie_id))');
        // $this->addSql('CREATE INDEX IDX_934886107294869C ON article_categorie (article_id)');
        // $this->addSql('CREATE INDEX IDX_93488610BCF5E72D ON article_categorie (categorie_id)');
        // $this->addSql('CREATE TABLE article_nature (article_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(article_id, nature_id))');
        // $this->addSql('CREATE INDEX IDX_DB1F15277294869C ON article_nature (article_id)');
        // $this->addSql('CREATE INDEX IDX_DB1F15273BCB2E4B ON article_nature (nature_id)');
        // $this->addSql('CREATE TABLE article_auteur (article_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY(article_id, auteur_id))');
        // $this->addSql('CREATE INDEX IDX_6F9D26C07294869C ON article_auteur (article_id)');
        // $this->addSql('CREATE INDEX IDX_6F9D26C060BB6FE6 ON article_auteur (auteur_id)');
        // $this->addSql('CREATE TABLE auteur (id INT NOT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE categorie (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE genre (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE genre_nature (genre_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(genre_id, nature_id))');
        // $this->addSql('CREATE INDEX IDX_5A6BB2874296D31F ON genre_nature (genre_id)');
        // $this->addSql('CREATE INDEX IDX_5A6BB2873BCB2E4B ON genre_nature (nature_id)');
        // $this->addSql('CREATE TABLE invite (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_C7E210D7E7927C74 ON invite (email)');
        // $this->addSql('CREATE TABLE langage (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE liste_objets (id INT NOT NULL, langages_id INT DEFAULT NULL, proprietaire_id INT DEFAULT NULL, emprunteur_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description BYTEA NOT NULL, est_emprunte BOOLEAN DEFAULT NULL, date_suppression TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE INDEX IDX_23BCFE2C88BBA17 ON liste_objets (langages_id)');
        // $this->addSql('CREATE INDEX IDX_23BCFE276C50E4A ON liste_objets (proprietaire_id)');
        // $this->addSql('CREATE INDEX IDX_23BCFE2F0840037 ON liste_objets (emprunteur_id)');
        // $this->addSql('CREATE INDEX IDX_23BCFE2A21214B7 ON liste_objets (categories_id)');
        // $this->addSql('CREATE TABLE liste_objets_auteur (liste_objets_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY(liste_objets_id, auteur_id))');
        // $this->addSql('CREATE INDEX IDX_F4100C80314EE359 ON liste_objets_auteur (liste_objets_id)');
        // $this->addSql('CREATE INDEX IDX_F4100C8060BB6FE6 ON liste_objets_auteur (auteur_id)');
        // $this->addSql('CREATE TABLE nature (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        // $this->addSql('CREATE TABLE nature_nature (nature_source INT NOT NULL, nature_target INT NOT NULL, PRIMARY KEY(nature_source, nature_target))');
        // $this->addSql('CREATE INDEX IDX_85D420706B86DDA4 ON nature_nature (nature_source)');
        // $this->addSql('CREATE INDEX IDX_85D4207072638D2B ON nature_nature (nature_target)');
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
        // $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_nature ADD CONSTRAINT FK_DB1F15277294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_nature ADD CONSTRAINT FK_DB1F15273BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2874296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE genre_nature ADD CONSTRAINT FK_5A6BB2873BCB2E4B FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT FK_23BCFE2C88BBA17 FOREIGN KEY (langages_id) REFERENCES langage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT FK_23BCFE276C50E4A FOREIGN KEY (proprietaire_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT FK_23BCFE2F0840037 FOREIGN KEY (emprunteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT FK_23BCFE2A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets_auteur ADD CONSTRAINT FK_F4100C80314EE359 FOREIGN KEY (liste_objets_id) REFERENCES liste_objets (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE liste_objets_auteur ADD CONSTRAINT FK_F4100C8060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT FK_85D420706B86DDA4 FOREIGN KEY (nature_source) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        // $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT FK_85D4207072638D2B FOREIGN KEY (nature_target) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article_langage DROP CONSTRAINT FK_2182AE917294869C');
        $this->addSql('ALTER TABLE article_categorie DROP CONSTRAINT FK_934886107294869C');
        $this->addSql('ALTER TABLE article_nature DROP CONSTRAINT FK_DB1F15277294869C');
        $this->addSql('ALTER TABLE article_auteur DROP CONSTRAINT FK_6F9D26C07294869C');
        $this->addSql('ALTER TABLE article_auteur DROP CONSTRAINT FK_6F9D26C060BB6FE6');
        $this->addSql('ALTER TABLE liste_objets_auteur DROP CONSTRAINT FK_F4100C8060BB6FE6');
        $this->addSql('ALTER TABLE article_categorie DROP CONSTRAINT FK_93488610BCF5E72D');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT FK_23BCFE2A21214B7');
        $this->addSql('ALTER TABLE genre_nature DROP CONSTRAINT FK_5A6BB2874296D31F');
        $this->addSql('ALTER TABLE article_langage DROP CONSTRAINT FK_2182AE91957BB53C');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT FK_23BCFE2C88BBA17');
        $this->addSql('ALTER TABLE liste_objets_auteur DROP CONSTRAINT FK_F4100C80314EE359');
        $this->addSql('ALTER TABLE article_nature DROP CONSTRAINT FK_DB1F15273BCB2E4B');
        $this->addSql('ALTER TABLE genre_nature DROP CONSTRAINT FK_5A6BB2873BCB2E4B');
        $this->addSql('ALTER TABLE nature_nature DROP CONSTRAINT FK_85D420706B86DDA4');
        $this->addSql('ALTER TABLE nature_nature DROP CONSTRAINT FK_85D4207072638D2B');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E6676C50E4A');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66F0840037');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT FK_23BCFE276C50E4A');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT FK_23BCFE2F0840037');
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
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE article_nature');
        $this->addSql('DROP TABLE article_auteur');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_nature');
        $this->addSql('DROP TABLE invite');
        $this->addSql('DROP TABLE langage');
        $this->addSql('DROP TABLE liste_objets');
        $this->addSql('DROP TABLE liste_objets_auteur');
        $this->addSql('DROP TABLE nature');
        $this->addSql('DROP TABLE nature_nature');
        $this->addSql('DROP TABLE "user"');
        //$this->addSql('DROP TABLE user1');
        $this->addSql('DROP TABLE users');
    }
}
