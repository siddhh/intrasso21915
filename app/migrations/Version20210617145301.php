<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617145301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liste_objets_nature');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        //$this->addSql('CREATE TABLE liste_objets_nature (liste_objets_id INT NOT NULL, nature_id INT NOT NULL, PRIMARY KEY(liste_objets_id, nature_id))');
        $this->addSql('CREATE INDEX idx_40923f67314ee359 ON liste_objets_nature (liste_objets_id)');
        $this->addSql('CREATE INDEX idx_40923f673bcb2e4b ON liste_objets_nature (nature_id)');
        $this->addSql('ALTER TABLE liste_objets_nature ADD CONSTRAINT fk_40923f67314ee359 FOREIGN KEY (liste_objets_id) REFERENCES liste_objets (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets_nature ADD CONSTRAINT fk_40923f673bcb2e4b FOREIGN KEY (nature_id) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
