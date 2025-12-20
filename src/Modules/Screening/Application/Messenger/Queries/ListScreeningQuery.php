<?php

declare(strict_types=1);

namespace App\Modules\Screening\Application\Messenger\Queries;

use App\Modules\Room\Domain\ValueObject\Query\ListScreeningQueryVO;

final readonly class ListScreeningQuery
{
    public function __construct(
        public int $currentPage,
        public int $pageSize,
    ) {
    }

    public function toListRoomQueryVO(): ListScreeningQueryVO
    {
        return new ListScreeningQueryVO(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
        );
    }
}
