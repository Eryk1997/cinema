<?php

namespace App\Modules\Room\Application\Factory;

use App\Modules\Room\Application\Exception\NotFoundRoomException;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\Repositories\RoomQueryRepositoryInterface;

final readonly  class RoomProvider
{
    public function __construct(
        private RoomQueryRepositoryInterface $roomQueryRepository,
    )
    {
    }

    public function finByName(string $name): Room
    {
        $room = $this->roomQueryRepository->findOneByName($name);

        if (!$room)  {
            throw new NotFoundRoomException('room.not_found');
        }

        return $room;
    }
}
