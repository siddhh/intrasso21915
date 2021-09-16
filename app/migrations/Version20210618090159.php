<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618090159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nature_nature (nature_source INT NOT NULL, nature_target INT NOT NULL, PRIMARY KEY(nature_source, nature_target))');
        $this->addSql('CREATE INDEX IDX_85D420706B86DDA4 ON nature_nature (nature_source)');
        $this->addSql('CREATE INDEX IDX_85D4207072638D2B ON nature_nature (nature_target)');
        $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT FK_85D420706B86DDA4 FOREIGN KEY (nature_source) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature_nature ADD CONSTRAINT FK_85D4207072638D2B FOREIGN KEY (nature_target) REFERENCES nature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nature DROP CONSTRAINT fk_b1d882a7a21214b7');
        $this->addSql('DROP INDEX idx_b1d882a7a21214b7');
        $this->addSql('ALTER TABLE nature DROP categories_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE nature_nature');
        $this->addSql('ALTER TABLE nature ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nature ADD CONSTRAINT fk_b1d882a7a21214b7 FOREIGN KEY (categories_id) REFERENCES nature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_b1d882a7a21214b7 ON nature (categories_id)');
    }
}
