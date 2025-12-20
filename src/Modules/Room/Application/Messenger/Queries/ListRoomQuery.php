<?php

namespace App\Modules\Room\Application\Messenger\Queries;

use App\Modules\Room\Domain\ValueObject\Query\ListRoomQueryVO;

final readonly class ListRoomQuery
{
    public function __construct(
        public int $currentPage,
        public int $pageSize,
    )
    {
    }

    public function toListRoomQueryVO(): ListRoomQueryVO
    {
        return new ListRoomQueryVO(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
        );
    }
}
