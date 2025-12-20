<?php

namespace App\Modules\Room\Seat\Domain\Entity;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Seat\Domain\Embeddable\Column;
use App\Modules\Room\Seat\Domain\Embeddable\Row;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[Entity]
#[Table(name: 'seats')]
#[HasLifecycleCallbacks]
class Seat
{
    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'seats')]
    private Room $room;

    public function __construct(
        #[Id]
        #[ORM\Column(type: 'uuid_mariadb', unique: true)]
        private Uuid $id,
        #[ORM\Embedded(class: Row::class, columnPrefix: 'seat_row_')]
        private Row $row,
        #[ORM\Embedded(class: Column::class, columnPrefix: 'seat_column_')]
        private Column $column,
    )
    {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getRow(): Row
    {
        return $this->row;
    }

    public function getColumn(): Column
    {
        return $this->column;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    public function setRow(Row $row): void
    {
        $this->row = $row;
    }

    public function setColumn(Column $column): void
    {
        $this->column = $column;
    }
}
