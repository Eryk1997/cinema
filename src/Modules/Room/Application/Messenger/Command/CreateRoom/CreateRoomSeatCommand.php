<?php

namespace App\Modules\Room\Application\Messenger\Command\CreateRoom;

use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Modules\Room\Seat\Domain\ValueObject\SeatId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class CreateRoomSeatCommand
{
    public function __construct(
        public SeatId $seatId,
        public int $row,
        public int $column,
    )
    {
    }
}
