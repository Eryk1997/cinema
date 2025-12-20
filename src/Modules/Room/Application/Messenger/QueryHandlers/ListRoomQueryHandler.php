<?php

namespace App\Modules\Room\Application\Messenger\QueryHandlers;

use App\Modules\Room\Application\Messenger\Queries\ListRoomQuery;
use App\Modules\Room\Domain\Repositories\RoomQueryRepositoryInterface;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListRoomQueryHandler
{
    public function __construct(
        public RoomQueryRepositoryInterface $roomQueryRepository,
    )
    {
    }

    public function __invoke(ListRoomQuery $query): PaginatorVO
    {
        $paginator = $this->roomQueryRepository->findByListRoomQuery($query->toListRoomQueryVO());

        return new PaginatorVO(
            data: iterator_to_array($paginator),
            pageSize: $query->pageSize,
            totalCount: $paginator->count(),
            currentPage: $query->currentPage,
        );
    }
}
