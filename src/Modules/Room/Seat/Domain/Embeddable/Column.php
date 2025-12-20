<?php

namespace App\Modules\Room\Seat\Domain\Embeddable;

use App\Modules\Room\Domain\Exception\RoomException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Column as OrmColumn;

#[Embeddable]
class Column
{
    private const MAX_LENGTH = 40;

    public function __construct(
        #[OrmColumn(type: Types::INTEGER, length: self::MAX_LENGTH)]
        private int $column,
    ) {
        if ($this->column > self::MAX_LENGTH) {
            throw new RoomException('room.column.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getColumn(): string
    {
        return $this->column;
    }
}
