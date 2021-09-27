<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927085907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP CONSTRAINT fk_23a0e666bf700bd');
        $this->addSql('DROP SEQUENCE article_status_id_seq CASCADE');
        $this->addSql('DROP TABLE article_status');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT fk_23a0e6670e4f16e');
        $this->addSql('DROP INDEX idx_23a0e666bf700bd');
        $this->addSql('DROP INDEX idx_23a0e6670e4f16e');
        $this->addSql('ALTER TABLE article DROP reserve_par_id');
        $this->addSql('ALTER TABLE article DROP status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE article_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article_status (id INT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE article ADD reserve_par_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_23a0e6670e4f16e FOREIGN KEY (reserve_par_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT fk_23a0e666bf700bd FOREIGN KEY (status_id) REFERENCES article_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_23a0e666bf700bd ON article (status_id)');
        $this->addSql('CREATE INDEX idx_23a0e6670e4f16e ON article (reserve_par_id)');
    }
}
