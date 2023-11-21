<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121122259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, genres LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', publication_date DATETIME DEFAULT NULL, platform LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_editor (game_id INT NOT NULL, editor_id INT NOT NULL, INDEX IDX_B1C45C72E48FD905 (game_id), INDEX IDX_B1C45C726995AC4C (editor_id), PRIMARY KEY(game_id, editor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_studio (game_id INT NOT NULL, studio_id INT NOT NULL, INDEX IDX_371EAA7EE48FD905 (game_id), INDEX IDX_371EAA7E446F285F (studio_id), PRIMARY KEY(game_id, studio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studio (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_editor ADD CONSTRAINT FK_B1C45C72E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_editor ADD CONSTRAINT FK_B1C45C726995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_studio ADD CONSTRAINT FK_371EAA7EE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_studio ADD CONSTRAINT FK_371EAA7E446F285F FOREIGN KEY (studio_id) REFERENCES studio (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game_editor DROP FOREIGN KEY FK_B1C45C72E48FD905');
        $this->addSql('ALTER TABLE game_editor DROP FOREIGN KEY FK_B1C45C726995AC4C');
        $this->addSql('ALTER TABLE game_studio DROP FOREIGN KEY FK_371EAA7EE48FD905');
        $this->addSql('ALTER TABLE game_studio DROP FOREIGN KEY FK_371EAA7E446F285F');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_editor');
        $this->addSql('DROP TABLE game_studio');
        $this->addSql('DROP TABLE studio');
    }
}
