<?php

namespace App\Modules\Reservation\Api\Model\Create;

use App\Modules\Reservation\Application\Messenger\Command\CreateReservationSeatCommand;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class CreateSeatRequestModel
{
    public function __construct(
        #[NotBlank]
        public string $id,
    )
    {
    }

    public function toCreateReservationSeatCommand(): CreateReservationSeatCommand
    {
        return new CreateReservationSeatCommand(
            id: $this->id,
        );
    }
}
