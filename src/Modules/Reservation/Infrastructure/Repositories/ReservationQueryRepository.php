<?php

namespace App\Modules\Reservation\Infrastructure\Repositories;

use App\Modules\Reservation\Domain\Entity\Reservation;
use App\Modules\Reservation\Domain\Repositories\ReservationQueryRepositoryInterface;
use App\Modules\Room\Domain\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationQueryRepository extends ServiceEntityRepository implements ReservationQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function isSeatTaken(string $seatId, string $screeningId): bool
    {
        $qb = $this->createQueryBuilder('r')
            ->innerJoin('r.seats', 's')
            ->where('r.screening = :screeningId')
            ->andWhere('s.id = :seatId')
            ->setParameter('screeningId', $screeningId)
            ->setParameter('seatId', $seatId);

        return count($qb->getQuery()->getResult()) > 0;
    }
}
