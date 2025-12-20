<?php

namespace App\Modules\Reservation\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListRoomQueryVO;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface ReservationQueryRepositoryInterface
{
    public function isSeatTaken(string $seatId, string $screeningId): bool;
}
