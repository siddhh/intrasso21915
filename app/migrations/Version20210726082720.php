<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726082720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liste_objets_auteur');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT fk_23bcfe2c88bba17');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT fk_23bcfe276c50e4a');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT fk_23bcfe2f0840037');
        $this->addSql('ALTER TABLE liste_objets DROP CONSTRAINT fk_23bcfe2a21214b7');
        $this->addSql('DROP INDEX idx_23bcfe2f0840037');
        $this->addSql('DROP INDEX idx_23bcfe276c50e4a');
        $this->addSql('DROP INDEX idx_23bcfe2c88bba17');
        $this->addSql('DROP INDEX idx_23bcfe2a21214b7');
        $this->addSql('ALTER TABLE liste_objets DROP langages_id');
        $this->addSql('ALTER TABLE liste_objets DROP proprietaire_id');
        $this->addSql('ALTER TABLE liste_objets DROP emprunteur_id');
        $this->addSql('ALTER TABLE liste_objets DROP categories_id');
        $this->addSql('ALTER TABLE liste_objets DROP titre');
        $this->addSql('ALTER TABLE liste_objets DROP description');
        $this->addSql('ALTER TABLE liste_objets DROP est_emprunte');
        $this->addSql('ALTER TABLE liste_objets DROP date_suppression');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        //$this->addSql('CREATE TABLE liste_objets_auteur (liste_objets_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY(liste_objets_id, auteur_id))');
        $this->addSql('CREATE INDEX idx_f4100c80314ee359 ON liste_objets_auteur (liste_objets_id)');
        $this->addSql('CREATE INDEX idx_f4100c8060bb6fe6 ON liste_objets_auteur (auteur_id)');
        $this->addSql('ALTER TABLE liste_objets_auteur ADD CONSTRAINT fk_f4100c80314ee359 FOREIGN KEY (liste_objets_id) REFERENCES liste_objets (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets_auteur ADD CONSTRAINT fk_f4100c8060bb6fe6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets ADD langages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD proprietaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD emprunteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD description BYTEA NOT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD est_emprunte BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD date_suppression TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT fk_23bcfe2c88bba17 FOREIGN KEY (langages_id) REFERENCES langage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT fk_23bcfe276c50e4a FOREIGN KEY (proprietaire_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT fk_23bcfe2f0840037 FOREIGN KEY (emprunteur_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE liste_objets ADD CONSTRAINT fk_23bcfe2a21214b7 FOREIGN KEY (categories_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_23bcfe2f0840037 ON liste_objets (emprunteur_id)');
        $this->addSql('CREATE INDEX idx_23bcfe276c50e4a ON liste_objets (proprietaire_id)');
        $this->addSql('CREATE INDEX idx_23bcfe2c88bba17 ON liste_objets (langages_id)');
        $this->addSql('CREATE INDEX idx_23bcfe2a21214b7 ON liste_objets (categories_id)');
    }
}
