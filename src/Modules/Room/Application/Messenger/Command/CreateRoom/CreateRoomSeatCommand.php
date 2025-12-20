<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Messenger\Command\CreateRoom;

use App\Modules\Room\Seat\Domain\ValueObject\SeatId;

class CreateRoomSeatCommand
{
    public function __construct(
        public SeatId $seatId,
        public int $row,
        public int $column,
    ) {
    }
}
