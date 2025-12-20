<?php

namespace App\Modules\Room\Domain\ValueObject\Query;

final readonly class ListScreeningQueryVO
{
    public function __construct(
        public int $currentPage,
        public int $pageSize,
    ) {
    }
}
