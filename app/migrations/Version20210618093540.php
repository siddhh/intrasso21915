<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618093540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        
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
        $this->addSql('ALTER TABLE article_langage DROP CONSTRAINT FK_2182AE91957BB53C');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT FK_23BCFE2C88BBA17');
        $this->addSql('ALTER TABLE liste_objets_auteur DROP CONSTRAINT FK_F4100C80314EE359');
        $this->addSql('ALTER TABLE article_nature DROP CONSTRAINT FK_DB1F15273BCB2E4B');
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
        $this->addSql('DROP SEQUENCE invite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE langage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE liste_objets_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        // $this->addSql('DROP SEQUENCE user1_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_langage');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE article_nature');
        $this->addSql('DROP TABLE article_auteur');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE invite');
        $this->addSql('DROP TABLE langage');
        $this->addSql('DROP TABLE liste_objets');
        $this->addSql('DROP TABLE liste_objets_auteur');
        $this->addSql('DROP TABLE nature');
        $this->addSql('DROP TABLE nature_nature');
        $this->addSql('DROP TABLE "user"');
        // $this->addSql('DROP TABLE user1');
        $this->addSql('DROP TABLE users');
    }
}
