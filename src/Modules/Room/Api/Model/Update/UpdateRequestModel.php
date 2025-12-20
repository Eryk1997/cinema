<?php

namespace App\Modules\Room\Api\Model\Update;


use App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand\UpdateRoomCommand;
use App\Modules\Room\Domain\ValueObject\RoomId;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class UpdateRequestModel
{
    /** @param SeatRequestModel[] $seats */
    public function __construct(
        #[NotBlank]
        public string $name,
        public array $seats,
    )
    {
    }

    public function toUpdateRoomCommand(string $id): UpdateRoomCommand
    {
        $seats = [];

        foreach ($this->seats as $seat) {
            $seats[] = $seat->toUpdateRoomSeatCommand();
        }

        return new UpdateRoomCommand(
            roomId: RoomId::fromString($id),
            name: $this->name,
            seats: $seats,
        );
    }
}
