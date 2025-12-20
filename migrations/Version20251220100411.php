<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Uuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251220100411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $id = Uuid::v7()->toRfc4122();

        // HASH HASŁA (bcrypt)
        $hashedPassword = password_hash('test123', PASSWORD_BCRYPT);

        $this->addSql(
            'INSERT INTO users (id, fist_name, last_name, email, password, type)
             VALUES (:id, :firstName, :lastName, :email, :password, :type)',
            [
                'id' => $id,
                'firstName' => 'Eryk',
                'lastName' => 'Janocha',
                'email' => 'eryk.janocha@gmail.com',
                'password' => $hashedPassword,
                'type' => 'AMIN',
            ]
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
