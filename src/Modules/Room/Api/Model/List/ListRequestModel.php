<?php

namespace App\Modules\Room\Api\Model\List;

use App\Modules\Room\Application\Messenger\Queries\ListRoomQuery;

readonly class ListRequestModel
{
    public function __construct(
        public int $currentPage = 1,
        public int $pageSize = 50,
    )
    {
    }

    public function toListRoomQuery(): ListRoomQuery
    {
        return new ListRoomQuery(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
        );
    }
}
