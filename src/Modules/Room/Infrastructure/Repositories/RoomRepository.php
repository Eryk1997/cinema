<?php

declare(strict_types=1);

namespace App\Modules\Room\Infrastructure\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\Repositories\RoomRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Room>
 */
class RoomRepository extends ServiceEntityRepository implements RoomRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function save(Room $room): void
    {
        $this->getEntityManager()->persist($room);
        $this->getEntityManager()->flush();
    }

    public function remove(Room $room): void
    {
        $this->getEntityManager()->remove($room);
        $this->getEntityManager()->flush();
    }
}
