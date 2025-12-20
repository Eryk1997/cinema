<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Messenger\Command\CreateRoom;

use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class CreateRoomCommand implements Command
{
    /** @param CreateRoomSeatCommand[] $seats */
    public function __construct(
        public RoomId $roomId,
        public string $name,
        public array $seats,
    ) {
    }
}
