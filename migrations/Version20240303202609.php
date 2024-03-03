<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303202609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC76C50E4A');
        $this->addSql('DROP INDEX IDX_67F068BC76C50E4A ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP proprietaire_id');
        $this->addSql('ALTER TABLE moto DROP nombre_notes, DROP moyenne_notes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD proprietaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC76C50E4A ON commentaire (proprietaire_id)');
        $this->addSql('ALTER TABLE moto ADD nombre_notes INT DEFAULT NULL, ADD moyenne_notes NUMERIC(3, 2) DEFAULT NULL');
    }
}
