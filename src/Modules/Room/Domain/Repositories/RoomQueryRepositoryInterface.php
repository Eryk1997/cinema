<?php

namespace App\Modules\Room\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListRoomQueryVO;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface RoomQueryRepositoryInterface
{
    public function findOneByName(string $name): ?Room;

    public function findOneById(string $id): ?Room;

    /** @return Paginator<Room> */
    public function findByListRoomQuery(ListRoomQueryVO $query): Paginator;
}
