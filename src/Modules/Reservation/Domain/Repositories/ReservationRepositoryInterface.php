<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Repositories;

use App\Modules\Reservation\Domain\Entity\Reservation;

interface ReservationRepositoryInterface
{
    public function save(Reservation $reservation): void;
}
