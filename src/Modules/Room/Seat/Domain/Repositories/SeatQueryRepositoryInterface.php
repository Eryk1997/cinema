<?php

declare(strict_types=1);

namespace App\Modules\Room\Seat\Domain\Repositories;

use App\Modules\Room\Seat\Domain\Entity\Seat;

interface SeatQueryRepositoryInterface
{
    public function findById(string $id): ?Seat;
}
