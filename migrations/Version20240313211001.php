<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313211001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moto DROP FOREIGN KEY FK_3DDDBCE44827B9B2');
        $this->addSql('DROP INDEX IDX_3DDDBCE44827B9B2 ON moto');
        $this->addSql('ALTER TABLE moto CHANGE marque_id modele_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE4AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_3DDDBCE4AC14B70A ON moto (modele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moto DROP FOREIGN KEY FK_3DDDBCE4AC14B70A');
        $this->addSql('DROP INDEX IDX_3DDDBCE4AC14B70A ON moto');
        $this->addSql('ALTER TABLE moto CHANGE modele_id marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE44827B9B2 FOREIGN KEY (marque_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_3DDDBCE44827B9B2 ON moto (marque_id)');
    }
}
