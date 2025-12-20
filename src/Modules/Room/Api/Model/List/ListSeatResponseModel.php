<?php

namespace App\Modules\Room\Api\Model\List;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListSeatResponseModel
{
    public function __construct(
        public int $row,
        public int $column,
    )
    {
    }

    public static function fromSeat(Seat $seat): self
    {
        return new self(
            row: $seat->getRow()->getNumber(),
            column: $seat->getColumn()->getNumber(),
        );
    }
}
