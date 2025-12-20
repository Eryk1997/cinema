<?php

namespace App\Modules\Room\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;

interface RoomQueryRepositoryInterface
{
    public function findOneByName(string $name): ?Room;
}
