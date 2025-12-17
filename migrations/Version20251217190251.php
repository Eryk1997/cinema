<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251217190251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rooms (id UUID NOT NULL, value VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7CA11A961D775834 (value), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE seats (id UUID NOT NULL, row INT NOT NULL, `column` INT NOT NULL, room_id UUID DEFAULT NULL, INDEX IDX_BFE2575054177093 (room_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE seats ADD CONSTRAINT FK_BFE2575054177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seats DROP FOREIGN KEY FK_BFE2575054177093');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE seats');
    }
}
