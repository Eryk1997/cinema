<?php

namespace App\Modules\Screening\Application\Messenger\QueryHandlers;

use App\Modules\Reservation\Domain\Repositories\ReservationQueryRepositoryInterface;
use App\Modules\Room\Domain\Repositories\RoomQueryRepositoryInterface;
use App\Modules\Screening\Api\Model\List\ListResponseModel;
use App\Modules\Screening\Application\Messenger\Queries\ListScreeningQuery;
use App\Modules\Screening\Domain\Repositories\ScreeningQueryRepositoryInterface;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListRoomQueryHandler
{
    public function __construct(
        public ScreeningQueryRepositoryInterface $screeningQueryRepository,
        private ReservationQueryRepositoryInterface $reservationQueryRepository,
    )
    {
    }

    public function __invoke(ListScreeningQuery $query): PaginatorVO
    {
        $paginator = $this->screeningQueryRepository->findByListQuery($query->toListRoomQueryVO());
        $screenings = iterator_to_array($paginator);

        $data = [];

        foreach ($screenings as $screening) {
            $reservedSeatIds = $this->reservationQueryRepository->findReservedSeatIdsForScreening($screening->getId());

            $data[] = ListResponseModel::fromScreening($screening, $reservedSeatIds);
        }

        return new PaginatorVO(
            data: $data,
            pageSize: $query->pageSize,
            totalCount: $paginator->count(),
            currentPage: $query->currentPage,
        );
    }
}
