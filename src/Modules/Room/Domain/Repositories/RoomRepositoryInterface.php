<?php

declare(strict_types=1);

namespace App\Modules\Room\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;

interface RoomRepositoryInterface
{
    public function save(Room $room): void;

    public function remove(Room $room): void;
}
