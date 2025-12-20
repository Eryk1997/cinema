<?php

namespace App\Modules\Room\Seat\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListRoomQueryVO;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Modules\Screening\Domain\Entity\Screening;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface SeatQueryRepositoryInterface
{
    public function findById(string $id): ?Seat;
}
