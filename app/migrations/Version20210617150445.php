<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617150445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_auteur (article_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY(article_id, auteur_id))');
        $this->addSql('CREATE INDEX IDX_6F9D26C07294869C ON article_auteur (article_id)');
        $this->addSql('CREATE INDEX IDX_6F9D26C060BB6FE6 ON article_auteur (auteur_id)');
        $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C07294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_auteur ADD CONSTRAINT FK_6F9D26C060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE article_auteur');
    }
}
