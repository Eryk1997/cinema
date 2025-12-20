<?php

declare(strict_types=1);

namespace App\Modules\Room\Api\Model\Update;

use App\Modules\Room\Application\Messenger\Command\UpdateRoomCommand\UpdateRoomSeatCommand;
use App\Modules\Room\Seat\Domain\ValueObject\SeatId;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class SeatRequestModel
{
    public function __construct(
        #[NotBlank]
        public int $row,
        #[NotBlank]
        public int $column,
        #[NotBlank]
        public ?string $id = null,
    ) {
    }

    public function toUpdateRoomSeatCommand(): UpdateRoomSeatCommand
    {
        return new UpdateRoomSeatCommand(
            row: $this->row,
            column: $this->column,
            seatId: isset($this->id) ? SeatId::fromString($this->id) : null,
        );
    }
}
