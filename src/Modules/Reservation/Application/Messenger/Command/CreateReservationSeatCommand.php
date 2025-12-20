<?php

namespace App\Modules\Reservation\Application\Messenger\Command;

use App\Shared\Infrastructure\Messenger\CommandBus\Command;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateReservationSeatCommand implements Command
{
    public function __construct(
        public string $id,
    )
    {
    }
}
