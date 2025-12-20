<?php

declare(strict_types=1);

namespace App\Modules\Screening\Application\Provider;

use App\Modules\Screening\Application\Exception\NotFoundScreeningException;
use App\Modules\Screening\Domain\Entity\Screening;
use App\Modules\Screening\Domain\Repositories\ScreeningQueryRepositoryInterface;

final readonly class ScreeningProvider
{
    public function __construct(
        private ScreeningQueryRepositoryInterface $queryRepository,
    ) {
    }

    public function findById(string $id): Screening
    {
        $screening = $this->queryRepository->findById($id);

        if (!$screening) {
            throw new NotFoundScreeningException('screening.not_found');
        }

        return $screening;
    }
}
