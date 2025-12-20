<?php

declare(strict_types=1);

namespace App\Modules\Room\Application\Messenger\Command\DeleteRoom;

use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class DeleteRoomCommand implements Command
{
    public function __construct(
        public string $id,
    ) {
    }
}
