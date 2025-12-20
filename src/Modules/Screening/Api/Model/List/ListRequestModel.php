<?php

namespace App\Modules\Screening\Api\Model\List;

use App\Modules\Screening\Application\Messenger\Queries\ListScreeningQuery;

readonly class ListRequestModel
{
    public function __construct(
        public int $currentPage = 1,
        public int $pageSize = 50,
    )
    {
    }

    public function toListRoomQuery(): ListScreeningQuery
    {
        return new ListScreeningQuery(
            currentPage: $this->currentPage,
            pageSize: $this->pageSize,
        );
    }
}
