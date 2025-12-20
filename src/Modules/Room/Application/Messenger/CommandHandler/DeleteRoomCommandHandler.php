<?php

namespace App\Modules\Room\Application\Messenger\CommandHandler;

use App\Modules\Room\Application\Messenger\Command\DeleteRoom\DeleteRoomCommand;
use App\Modules\Room\Application\Provider\RoomProvider;
use App\Modules\Room\Domain\Repositories\RoomRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class DeleteRoomCommandHandler
{
    public function __construct(
        private RoomProvider $roomProvider,
        private RoomRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(DeleteRoomCommand $command): void
    {
        $room = $this->roomProvider->finById($command->id);

        $this->repository->remove($room);
    }
}
