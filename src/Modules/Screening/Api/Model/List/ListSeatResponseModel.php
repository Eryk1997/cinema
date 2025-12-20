<?php

declare(strict_types=1);

namespace App\Modules\Screening\Api\Model\List;

use App\Modules\Room\Seat\Domain\Entity\Seat;

final readonly class ListSeatResponseModel
{
    public function __construct(
        public int $row,
        public int $column,
        public bool $isAvailable,
    ) {
    }

    public static function fromSeat(Seat $seat, bool $isAvailable): self
    {
        return new self(
            row: $seat->getRow()->getNumber(),
            column: $seat->getColumn()->getNumber(),
            isAvailable: $isAvailable
        );
    }
}
