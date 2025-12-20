<?php

namespace App\Modules\Reservation\Application\Messenger\Command;

use App\Modules\Reservation\Domain\ValueObject\ReservationId;
use App\Shared\Infrastructure\Messenger\CommandBus\Command;

class CreateReservationCommand implements Command
{
    /** @param CreateReservationSeatCommand[] $seats */
    public function __construct(
        public ReservationId $reservationId,
        public string $screeningId,
        public string $customerEmail,
        public array $seats,
    )
    {
    }
}
