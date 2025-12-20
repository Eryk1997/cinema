<?php

namespace App\Modules\Screening\Domain\Repositories;

use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\Query\ListScreeningQueryVO;
use App\Modules\Screening\Domain\Entity\Screening;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface ScreeningQueryRepositoryInterface
{
    public function findById(string $id): ?Screening;

    /** @return Paginator<Screening> */
    public function findByListQuery(ListScreeningQueryVO $query): Paginator;
}
