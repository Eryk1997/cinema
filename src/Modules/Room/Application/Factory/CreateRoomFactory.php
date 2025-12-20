<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Factory;

use App\Modules\Room\Application\Exception\NotFoundRoomException;
use App\Modules\Room\Application\Exception\RoomException;
use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomCommand;
use App\Modules\Room\Application\Provider\RoomProvider;
use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Seat\Application\Factory\CreateSeatFactory;

readonly class CreateRoomFactory
{
    public function __construct(
        private CreateSeatFactory $createSeatFactory,
        private RoomProvider $roomProvider,
    ) {
    }

    public function create(CreateRoomCommand $command): Room
    {
        try {
            $this->roomProvider->finByName($command->name);

            throw new RoomException('room.already_exists');
        } catch (NotFoundRoomException) {
            $room = new Room(
                id: $command->roomId->toUuid(),
                name: new Name($command->name),
            );

            foreach ($command->seats as $seatCommand) {
                $seat = $this->createSeatFactory->create($seatCommand);

                if ($room->existEqualSeat($seat)) {
                    throw new RoomException('room.seat.duplicate');
                }

                $room->addSeat($seat);
            }

            return $room;
        }
    }
}
