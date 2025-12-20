<?php

namespace App\Modules\Room\Application\Messenger\CommandHandler;

use App\Modules\Room\Application\Exception\RoomException;
use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomSeatCommand;
use App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand\UpdateRoomCommand;
use App\Modules\Room\Application\Provider\RoomProvider;
use App\Modules\Room\Domain\Embeddable\Name;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\Repositories\RoomRepositoryInterface;
use App\Modules\Room\Seat\Application\Factory\CreateSeatFactory;
use App\Modules\Room\Seat\Domain\Embeddable\Column;
use App\Modules\Room\Seat\Domain\Embeddable\Row;
use App\Modules\Room\Seat\Domain\ValueObject\SeatId;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UpdateRoomCommandHandler
{
    public function __construct(
        private RoomProvider $roomProvider,
        private RoomRepositoryInterface $repository,
        private CreateSeatFactory $createSeatFactory,
    )
    {
    }

    public function __invoke(UpdateRoomCommand $command): void
    {
        $room = $this->roomProvider->finById($command->roomId->jsonSerialize());

        $room->setName(new Name($command->name));

        $this->updateSeats(
            room: $room,
            command: $command,
        );

        $this->repository->save($room);
    }

    private function updateSeats(Room $room, UpdateRoomCommand $command): void
    {
        $currentSeats = $room->getSeats();

        $currentSeatsMap = [];
        foreach ($currentSeats as $currentSeat) {
            $currentSeatsMap[$currentSeat->getId()->toRfc4122()] = $currentSeat;
        }

        $newSeatsMap = [];
        foreach ($command->seats as $newSeat) {
            if ($newSeat->seatId) {
                $newSeatsMap[$newSeat->seatId->jsonSerialize()] = $newSeat;
            }
        }

        foreach ($currentSeats as $currentSeat) {
            if (!isset($newSeatsMap[$currentSeat->getId()->toRfc4122()])) {
                $room->removeSeat($currentSeat);
            }
        }

        foreach ($command->seats as $newSeat) {
            if ($newSeat->seatId) {
                $existSeat = $currentSeatsMap[$newSeat->seatId->jsonSerialize()] ?? null;

                if ($existSeat) {
                    $existSeat->setRow(new Row($newSeat->row));
                    $existSeat->setColumn(new Column($newSeat->column));

                    if ($room->existEqualSeat($existSeat)) {
                        throw new RoomException('room.seat.duplicate');
                    }
                }

                continue;
            }

            $seat = $this->createSeatFactory->create(new CreateRoomSeatCommand(
                seatId: SeatId::new(),
                row: $newSeat->row,
                column: $newSeat->column,
            ));

            $room->addSeat($seat);
        }
    }
}
