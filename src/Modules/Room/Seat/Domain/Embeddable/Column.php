<?php

declare(strict_types=1);

namespace App\Modules\Room\Seat\Domain\Embeddable;

use App\Modules\Room\Domain\Exception\RoomException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column as OrmColumn;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Column
{
    private const int MAX_LENGTH = 40;

    public function __construct(
        #[OrmColumn(type: Types::INTEGER, length: self::MAX_LENGTH)]
        private int $number,
    ) {
        if ($this->number > self::MAX_LENGTH) {
            throw new RoomException('room.column.max_length', ['%max%' => self::MAX_LENGTH]);
        }
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
