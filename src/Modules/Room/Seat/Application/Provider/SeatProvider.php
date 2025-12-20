<?php

declare(strict_types=1);

namespace App\Modules\Room\Seat\Application\Provider;

use App\Modules\Room\Seat\Application\Exception\SeatException;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Modules\Room\Seat\Domain\Repositories\SeatQueryRepositoryInterface;

final readonly class SeatProvider
{
    public function __construct(
        private SeatQueryRepositoryInterface $seatQueryRepository,
    ) {
    }

    public function findById(string $id): Seat
    {
        $seat = $this->seatQueryRepository->findById($id);

        if (!$seat) {
            throw new SeatException('seat.not_found');
        }

        return $seat;
    }
}
