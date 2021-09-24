<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811143440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE historique_article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE historique_article (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE historique_article_user (historique_article_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(historique_article_id, user_id))');
        $this->addSql('CREATE INDEX IDX_99D93B2BAC03C75 ON historique_article_user (historique_article_id)');
        $this->addSql('CREATE INDEX IDX_99D93B2BA76ED395 ON historique_article_user (user_id)');
        $this->addSql('CREATE TABLE historique_article_article (historique_article_id INT NOT NULL, article_id INT NOT NULL, PRIMARY KEY(historique_article_id, article_id))');
        $this->addSql('CREATE INDEX IDX_34B03413AC03C75 ON historique_article_article (historique_article_id)');
        $this->addSql('CREATE INDEX IDX_34B034137294869C ON historique_article_article (article_id)');
        $this->addSql('ALTER TABLE historique_article_user ADD CONSTRAINT FK_99D93B2BAC03C75 FOREIGN KEY (historique_article_id) REFERENCES historique_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE historique_article_user ADD CONSTRAINT FK_99D93B2BA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE historique_article_article ADD CONSTRAINT FK_34B03413AC03C75 FOREIGN KEY (historique_article_id) REFERENCES historique_article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE historique_article_article ADD CONSTRAINT FK_34B034137294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE historique_article_user DROP CONSTRAINT FK_99D93B2BAC03C75');
        $this->addSql('ALTER TABLE historique_article_article DROP CONSTRAINT FK_34B03413AC03C75');
        $this->addSql('DROP SEQUENCE historique_article_id_seq CASCADE');
        $this->addSql('DROP TABLE historique_article');
        $this->addSql('DROP TABLE historique_article_user');
        $this->addSql('DROP TABLE historique_article_article');
    }
}
