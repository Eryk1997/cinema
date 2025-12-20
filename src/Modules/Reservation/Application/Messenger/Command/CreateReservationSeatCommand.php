<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Messenger\Command;

use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class CreateReservationSeatCommand implements Command
{
    public function __construct(
        public string $id,
    ) {
    }
}
