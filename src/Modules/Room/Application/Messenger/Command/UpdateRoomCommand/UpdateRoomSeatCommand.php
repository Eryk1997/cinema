<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand;

use App\Modules\Room\Seat\Domain\ValueObject\SeatId;

class UpdateRoomSeatCommand
{
    public function __construct(
        public int $row,
        public int $column,
        public ?SeatId $seatId,
    ) {
    }
}
