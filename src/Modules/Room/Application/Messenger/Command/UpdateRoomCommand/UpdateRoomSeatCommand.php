<?php

namespace App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand;

use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Modules\Room\Seat\Domain\ValueObject\SeatId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class UpdateRoomSeatCommand
{
    public function __construct(
        public int $row,
        public int $column,
        public ?SeatId $seatId,
    )
    {
    }
}
