<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251220150656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservations (created_at DATE NOT NULL, id CHAR(36) NOT NULL, customer_email VARCHAR(255) NOT NULL, screening_id CHAR(36) NOT NULL, INDEX IDX_4DA23970F5295D (screening_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reservation_seats (reservation_id CHAR(36) NOT NULL, seat_id CHAR(36) NOT NULL, INDEX IDX_FC9D87F7B83297E7 (reservation_id), INDEX IDX_FC9D87F7C1DAFE35 (seat_id), PRIMARY KEY (reservation_id, seat_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE screenings (id CHAR(36) NOT NULL, movie_title VARCHAR(255) NOT NULL, start_time DATETIME NOT NULL, room_id CHAR(36) NOT NULL, INDEX IDX_350DCAA354177093 (room_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA23970F5295D FOREIGN KEY (screening_id) REFERENCES screenings (id)');
        $this->addSql('ALTER TABLE reservation_seats ADD CONSTRAINT FK_FC9D87F7B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_seats ADD CONSTRAINT FK_FC9D87F7C1DAFE35 FOREIGN KEY (seat_id) REFERENCES seats (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screenings ADD CONSTRAINT FK_350DCAA354177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA23970F5295D');
        $this->addSql('ALTER TABLE reservation_seats DROP FOREIGN KEY FK_FC9D87F7B83297E7');
        $this->addSql('ALTER TABLE reservation_seats DROP FOREIGN KEY FK_FC9D87F7C1DAFE35');
        $this->addSql('ALTER TABLE screenings DROP FOREIGN KEY FK_350DCAA354177093');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservation_seats');
        $this->addSql('DROP TABLE screenings');
    }
}
