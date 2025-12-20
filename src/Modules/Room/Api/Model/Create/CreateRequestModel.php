<?php

namespace App\Modules\Room\Api\Model\Create;

use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomCommand;
use App\Modules\Room\Domain\ValueObject\RoomId;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class CreateRequestModel
{
    /** @param SeatRequestModel[] $seats */
    public function __construct(
        #[NotBlank]
        public string $name,
        public array  $seats,
    )
    {
    }

    public function toCreateRoomCommand(): CreateRoomCommand
    {
        $roomId = RoomId::new();

        $seats = [];

        foreach ($this->seats as $seat) {
            $seats[] = $seat->toCreateRoomSeatCommand();
        }

        return new CreateRoomCommand(
            roomId: $roomId,
            name: $this->name,
            seats: $seats,
        );
    }
}
