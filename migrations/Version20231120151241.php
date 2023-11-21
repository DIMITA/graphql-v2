<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120151241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, genres CLOB NOT NULL --(DC2Type:array)
        , publication_date INTEGER DEFAULT NULL, platform CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('CREATE TABLE game_editor (game_id INTEGER NOT NULL, editor_id INTEGER NOT NULL, PRIMARY KEY(game_id, editor_id), CONSTRAINT FK_B1C45C72E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B1C45C726995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B1C45C72E48FD905 ON game_editor (game_id)');
        $this->addSql('CREATE INDEX IDX_B1C45C726995AC4C ON game_editor (editor_id)');
        $this->addSql('CREATE TABLE game_studio (game_id INTEGER NOT NULL, studio_id INTEGER NOT NULL, PRIMARY KEY(game_id, studio_id), CONSTRAINT FK_371EAA7EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_371EAA7E446F285F FOREIGN KEY (studio_id) REFERENCES studio (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_371EAA7EE48FD905 ON game_studio (game_id)');
        $this->addSql('CREATE INDEX IDX_371EAA7E446F285F ON game_studio (studio_id)');
        $this->addSql('CREATE TABLE studio (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_editor');
        $this->addSql('DROP TABLE game_studio');
        $this->addSql('DROP TABLE studio');
    }
}
