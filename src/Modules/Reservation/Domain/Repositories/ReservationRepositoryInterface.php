<?php

namespace App\Modules\Reservation\Domain\Repositories;

use App\Modules\Reservation\Domain\Entity\Reservation;
use App\Modules\Room\Domain\Entity\Room;

interface ReservationRepositoryInterface
{
    public function save(Reservation $reservation): void;
}
