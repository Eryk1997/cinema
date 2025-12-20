<?php

namespace App\Modules\Room\Seat\Infrastructure\Repositories;

use App\Modules\Room\Seat\Domain\Entity\Seat;
use App\Modules\Room\Seat\Domain\Repositories\SeatQueryRepositoryInterface;
use App\Modules\Screening\Domain\Entity\Screening;
use App\Modules\Screening\Domain\Repositories\ScreeningQueryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seat>
 */
class SeatQueryRepository extends ServiceEntityRepository implements SeatQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seat::class);
    }

    public function findById(string $id): ?Seat
    {
        return $this->find($id);
    }
}
