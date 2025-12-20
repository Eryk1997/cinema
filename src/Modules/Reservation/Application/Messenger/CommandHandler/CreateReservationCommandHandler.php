<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Application\Messenger\CommandHandler;

use App\Modules\Reservation\Application\Exception\ReservationException;
use App\Modules\Reservation\Application\Factory\CreateReservationFactory;
use App\Modules\Reservation\Application\Messenger\Command\CreateReservationCommand;
use App\Modules\Reservation\Domain\Repositories\ReservationQueryRepositoryInterface;
use App\Modules\Reservation\Domain\Repositories\ReservationRepositoryInterface;
use App\Modules\Room\Seat\Application\Provider\SeatProvider;
use App\Modules\Screening\Application\Provider\ScreeningProvider;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class CreateReservationCommandHandler
{
    public function __construct(
        private ScreeningProvider $screeningProvider,
        private ReservationQueryRepositoryInterface $reservationQueryRepository,
        private CreateReservationFactory $createReservationFactory,
        private ReservationRepositoryInterface $reservationRepository,
        private SeatProvider $seatProvider,
    ) {
    }

    public function __invoke(CreateReservationCommand $command): void
    {
        foreach ($command->seats as $seat) {
            if ($this->reservationQueryRepository->isSeatTaken(
                seatId: $seat->id,
                screeningId: $command->screeningId,
            )) {
                throw new ReservationException('reservation.already_taken');
            }
        }

        $screening = $this->screeningProvider->findById($command->screeningId);

        $reservation = $this->createReservationFactory->create(
            command: $command,
            screening: $screening,
        );

        $room = $screening->getRoom();

        $seatIds = array_map(fn ($s) => $s->id, $command->seats);

        foreach ($seatIds as $seatId) {
            $seat = $this->seatProvider->findById($seatId);

            $reservation->addSeat($seat);
        }

        foreach ($command->seats as $commandSeat) {
            foreach ($room->getSeats() as $seat) {
                if ($seat->getId()->toRfc4122() === $commandSeat->id) {
                    $reservation->addSeat($seat);
                }
            }
        }

        $this->reservationRepository->save($reservation);
    }
}
