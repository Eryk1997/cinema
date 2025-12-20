<?php

namespace App\Modules\Screening\Infrastructure\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListScreeningQueryVO;
use App\Modules\Screening\Domain\Entity\Screening;
use App\Modules\Screening\Domain\Repositories\ScreeningQueryRepositoryInterface;
use App\Shared\Infrastructure\Doctrine\Paginator\PaginatorFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
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

    /** @return Paginator<Screening> */
    public function findByListQuery(ListScreeningQueryVO $query): Paginator
    {
        $qb = $this->createQueryBuilder('s');

        return PaginatorFactory::createScalarFromQuery($qb->getQuery(), $query->currentPage, $query->pageSize);
    }
}
