<?php

declare(strict_types=1);

namespace App\Modules\Room\Seat\Application\Factory;

use App\Modules\Room\Application\Messenger\Command\CreateRoom\CreateRoomSeatCommand;
use App\Modules\Room\Seat\Domain\Embeddable\Column;
use App\Modules\Room\Seat\Domain\Embeddable\Row;
use App\Modules\Room\Seat\Domain\Entity\Seat;

class CreateSeatFactory
{
    public function create(CreateRoomSeatCommand $command): Seat
    {
        return new Seat(
            id: $command->seatId->toUuid(),
            row: new Row($command->row),
            column: new Column($command->column),
        );
    }
}
