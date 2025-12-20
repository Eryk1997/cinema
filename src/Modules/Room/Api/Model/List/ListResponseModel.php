<?php

namespace App\Modules\Room\Api\Model\List;

use App\Modules\Room\Domain\Entity\Room;
use App\Shared\Application\ValueObject\PaginatorVO;

final readonly class ListResponseModel
{
    /** @param ListSeatResponseModel[] $seats */
    public function __construct(
        public string $name,
        public array $seats,
    )
    {
    }

    /**
     * @param PaginatorVO<Room> $paginatorVO
     * @return self[]
     */
    public static function fromPaginatorVO(PaginatorVO $paginatorVO): array
    {
        return array_map(self::fromRoom(...), $paginatorVO->data);
    }

    public static function fromRoom(Room $room): self
    {
        return new self(
            name: $room->getName(),
            seats: array_map(ListSeatResponseModel::fromSeat(...), $room->getSeats()->toArray()),
        );
    }
}
