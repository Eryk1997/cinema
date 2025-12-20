<?php

namespace App\Modules\Room\Domain\ValueObject\Query;

final readonly class ListRoomQueryVO
{
    public function __construct(
        public int $currentPage,
        public int $pageSize,
    ) {
    }
}
