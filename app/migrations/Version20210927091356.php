<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210927091356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD reserve_par_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6670E4F16E FOREIGN KEY (reserve_par_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666BF700BD FOREIGN KEY (status_id) REFERENCES article_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_23A0E6670E4F16E ON article (reserve_par_id)');
        $this->addSql('CREATE INDEX IDX_23A0E666BF700BD ON article (status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E6670E4F16E');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E666BF700BD');
        $this->addSql('DROP INDEX IDX_23A0E6670E4F16E');
        $this->addSql('DROP INDEX IDX_23A0E666BF700BD');
        $this->addSql('ALTER TABLE article DROP reserve_par_id');
        $this->addSql('ALTER TABLE article DROP status_id');
    }
}
