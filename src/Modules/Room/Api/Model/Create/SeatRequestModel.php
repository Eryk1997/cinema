<?php

namespace App\Modules\Room\Api\Model\Create;

use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomCommand;
use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomSeatCommand;
use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Modules\Room\Seat\Domain\ValueObject\SeatId;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class SeatRequestModel
{
    public function __construct(
        #[NotBlank]
        public int $row,
        #[NotBlank]
        public int $column,
    )
    {
    }

    public function toCreateRoomSeatCommand(): CreateRoomSeatCommand
    {
        return new CreateRoomSeatCommand(
            seatId: SeatId::new(),
            row: $this->row,
            column: $this->column,
        );
    }
}
