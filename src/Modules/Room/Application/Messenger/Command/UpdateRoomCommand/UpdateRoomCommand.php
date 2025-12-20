<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand;

use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class UpdateRoomCommand implements Command
{
    /** @param UpdateRoomSeatCommand[] $seats */
    public function __construct(
        public RoomId $roomId,
        public string $name,
        public array $seats,
    ) {
    }
}
