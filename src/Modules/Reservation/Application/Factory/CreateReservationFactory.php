<?php

namespace App\Modules\Reservation\Application\Factory;

use App\Modules\Reservation\Application\Messenger\Command\CreateReservationCommand;
use App\Modules\Reservation\Domain\Entity\Reservation;
use App\Modules\Screening\Domain\Entity\Screening;

final class CreateReservationFactory
{
    public function create(CreateReservationCommand $command, Screening $screening): Reservation
    {
        return new Reservation(
            id: $command->reservationId->toUuid(),
            customerEmail: $command->customerEmail,
            screening: $screening,
        );
    }
}
