<?php

namespace App\Modules\Room\Infrastructure\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\Repositories\RoomQueryRepositoryInterface;
use App\Modules\Room\Domain\Repositories\RoomRepositoryInterface;
use App\Modules\Room\Domain\ValueObject\Query\ListScreeningQueryVO;
use App\Shared\Infrastructure\Doctrine\Paginator\PaginatorFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Room>
 */
class RoomQueryRepository extends ServiceEntityRepository implements RoomQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function findOneByName(string $name): ?Room
    {
        return $this->findOneBy(['name.value' => $name]);
    }

    public function findOneById(string $id): ?Room
    {
        return $this->find($id);
    }
}
