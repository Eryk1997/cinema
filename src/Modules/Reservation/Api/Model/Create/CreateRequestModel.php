<?php

namespace App\Modules\Reservation\Api\Model\Create;

use App\Modules\Reservation\Application\Messenger\Command\CreateReservationCommand;
use App\Modules\Reservation\Domain\ValueObject\ReservationId;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class CreateRequestModel
{
    /** @param CreateSeatRequestModel[] $seats */
    public function __construct(
        #[NotBlank]
        public string $screeningId,
        #[NotBlank]
        #[Email]
        public string $customerEmail,
        public array $seats,
    )
    {
    }

    public function toCreateReservationCommand(): CreateReservationCommand
    {
        $seats = [];

        foreach ($this->seats as $seat) {
            $seats[] = $seat->toCreateReservationSeatCommand();
        }

        return new CreateReservationCommand(
            reservationId: ReservationId::new(),
            screeningId: $this->screeningId,
            customerEmail: $this->customerEmail,
            seats: $seats,
        );
    }
}
