<?php

namespace App\Modules\Room\Seat\Domain\Embeddable;

use App\Modules\Room\Domain\Exception\RoomException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Row
{
    private const MAX_LENGTH = 20;

    public function __construct(
        #[Column(type: Types::INTEGER, length: self::MAX_LENGTH)]
        private int $row,
    ) {
        if ($this->row > self::MAX_LENGTH) {
            throw new RoomException('room.row.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getRow(): string
    {
        return $this->row;
    }
}
