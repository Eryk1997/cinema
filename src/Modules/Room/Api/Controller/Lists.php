<?php

namespace App\Modules\Room\Api\Controller;

use App\Modules\Room\Api\Model\List\ListRequestModel;
use App\Modules\Room\Api\Model\List\ListResponseModel;
use App\Modules\Room\Application\Messenger\QueryHandlers\ListRoomQueryHandler;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Api\Model\PaginationModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/rooms', name: 'api_rooms_lists', methods: ['GET'])]
class Lists extends AbstractApiController
{
    public function __invoke(
        #[MapQueryString]
        ListRequestModel $model,
        ListRoomQueryHandler $handler,
    ): JsonResponse
    {
        $vo = $handler($model->toListRoomQuery());

        return $this->successPaginatedData(
            ListResponseModel::fromPaginatorVO($vo),
            PaginationModel::fromPaginatorVO($vo),
        );
    }
}
