<?php

namespace App\Modules\Reservation\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListScreeningQueryVO;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface ReservationQueryRepositoryInterface
{
    public function isSeatTaken(string $seatId, string $screeningId): bool;

    /** @return string[] */
    public function findReservedSeatIdsForScreening(string $screeningId): array;
}
