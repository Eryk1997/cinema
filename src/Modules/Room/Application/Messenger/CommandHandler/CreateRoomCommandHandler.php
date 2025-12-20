<?php

namespace App\Modules\Room\Application\Messenger\CommandHandler;

use App\Modules\Room\Application\Factory\CreateRoomFactory;
use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomCommand;
use App\Modules\Room\Domain\Repositories\RoomRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreateRoomCommandHandler
{
    public function __construct(
        private CreateRoomFactory $createRoomFactory,
        private RoomRepositoryInterface $repository,
    )
    {
    }

    public function __invoke(CreateRoomCommand $command): void
    {
        $room = $this->createRoomFactory->create($command);

        $this->repository->save($room);
    }
}
