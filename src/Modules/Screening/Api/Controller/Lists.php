<?php

declare(strict_types=1);

namespace App\Modules\Screening\Api\Controller;

use App\Modules\Screening\Api\Model\List\ListRequestModel;
use App\Modules\Screening\Api\Model\List\ListResponseModel;
use App\Modules\Screening\Application\Messenger\QueryHandlers\ListRoomQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Api\Model\PaginationModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/screenings', name: 'api_screenings_lists', methods: ['GET'])]
class Lists extends AbstractApiController
{
    public function __invoke(
        #[MapQueryString]
        ListRequestModel $model,
        ListRoomQueryHandler $handler,
    ): JsonResponse {
        $vo = $handler($model->toListRoomQuery());

        return $this->successPaginatedData(
            ListResponseModel::fromPaginatorVO($vo),
            PaginationModel::fromPaginatorVO($vo),
        );
    }
}
