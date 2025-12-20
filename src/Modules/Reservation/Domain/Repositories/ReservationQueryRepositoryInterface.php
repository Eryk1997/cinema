<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Domain\Repositories;

interface ReservationQueryRepositoryInterface
{
    public function isSeatTaken(string $seatId, string $screeningId): bool;

    /** @return string[] */
    public function findReservedSeatIdsForScreening(string $screeningId): array;
}
