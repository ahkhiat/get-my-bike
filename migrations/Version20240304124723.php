<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240304124723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC78B8F2AC');
        $this->addSql('DROP INDEX IDX_67F068BC78B8F2AC ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP moto_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD moto_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC78B8F2AC FOREIGN KEY (moto_id) REFERENCES moto (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC78B8F2AC ON commentaire (moto_id)');
    }
}
