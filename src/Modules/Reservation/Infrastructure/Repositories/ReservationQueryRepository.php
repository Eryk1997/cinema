<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Infrastructure\Repositories;

use App\Modules\Reservation\Domain\Entity\Reservation;
use App\Modules\Reservation\Domain\Repositories\ReservationQueryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

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
            ->setParameter('seatId', $seatId)
        ;

        return count($qb->getQuery()->getResult()) > 0;
    }

    /** @return string[] */
    public function findReservedSeatIdsForScreening(string $screeningId): array
    {
        $result = $this->createQueryBuilder('r')
            ->select('s.id')
            ->innerJoin('r.seats', 's')
            ->where('r.screening = :screeningId')
            ->setParameter('screeningId', $screeningId, 'uuid_mariadb')
            ->getQuery()
            ->getScalarResult()
        ;

        return array_map(function ($item) {
            return Uuid::fromString($item['id'])->toRfc4122();
        }, $result);
    }
}
