<?php

namespace App\Modules\Screening\Infrastructure\Repositories;

use App\Modules\Screening\Domain\Entity\Screening;
use App\Modules\Screening\Domain\Repositories\ScreeningQueryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Screening>
 */
class ScreeningQueryRepository extends ServiceEntityRepository implements ScreeningQueryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Screening::class);
    }

    public function findById(string $id): ?Screening
    {
        return $this->find($id);
    }
}
