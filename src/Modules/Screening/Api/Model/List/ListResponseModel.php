<?php

namespace App\Modules\Screening\Api\Model\List;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Screening\Domain\Entity\Screening;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListResponseModel
{
    /** @param ListSeatResponseModel[] $seats */
    public function __construct(
        public string $movieTitle,
        public string $roomName,
        public string $startTime,
        public array $seats,
    )
    {
    }

    /**
     * @param PaginatorVO<Screening> $paginatorVO
     * @return self[]
     */
    public static function fromPaginatorVO(PaginatorVO $paginatorVO): array
    {
        return $paginatorVO->data;
    }

    /** @param string[] $reservedSeatIds */
    public static function fromScreening(Screening $screening, array $reservedSeatIds): self
    {
        return new self(
            movieTitle: $screening->getMovieTitle(),
            roomName: $screening->getRoom()->getName(),
            startTime: $screening->getStartTime()->format('Y-m-d H:i:s'),
            seats: array_map(
                fn($seat) => ListSeatResponseModel::fromSeat(
                    $seat,
                    !in_array($seat->getId()->toRfc4122(), $reservedSeatIds, true)
                ),
                $screening->getRoom()->getSeats()->toArray()
            ),
        );
    }
}
