<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207121802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE publicacion ADD categoria_id INT NOT NULL');
        $this->addSql('ALTER TABLE publicacion ADD CONSTRAINT FK_62F2085F3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
        $this->addSql('CREATE INDEX IDX_62F2085F3397707A ON publicacion (categoria_id)');
        $this->addSql('ALTER TABLE comentario ADD publicacion_id INT NOT NULL');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E7029ACBB5E7 FOREIGN KEY (publicacion_id) REFERENCES publicacion (id)');
        $this->addSql('CREATE INDEX IDX_4B91E7029ACBB5E7 ON comentario (publicacion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E7029ACBB5E7');
        $this->addSql('DROP INDEX IDX_4B91E7029ACBB5E7 ON comentario');
        $this->addSql('ALTER TABLE comentario DROP publicacion_id');
        $this->addSql('ALTER TABLE publicacion DROP FOREIGN KEY FK_62F2085F3397707A');
        $this->addSql('DROP INDEX IDX_62F2085F3397707A ON publicacion');
        $this->addSql('ALTER TABLE publicacion DROP categoria_id');
    }
}
