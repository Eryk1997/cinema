<?php

namespace App\Modules\Screening\Domain\Entity;

use App\Modules\Room\Domain\Entity\Room;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Uuid;

#[Entity]
#[Table(name: 'screenings')]
class Screening
{
    public function __construct(
        #[Id]
        #[Column(type: 'uuid_mariadb', unique: true)]
        private Uuid $id,
        #[Column(type: Types::STRING)]
        private string $movieTitle, // or replace by entity
        #[Column(type: Types::DATETIME_IMMUTABLE)]
        private \DateTimeImmutable $startTime,
        #[ManyToOne(targetEntity: Room::class)]
        #[JoinColumn(nullable: false)]
        private Room $room,
    )
    {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getStartTime(): \DateTimeImmutable
    {
        return $this->startTime;
    }

    public function getMovieTitle(): string
    {
        return $this->movieTitle;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }
}
