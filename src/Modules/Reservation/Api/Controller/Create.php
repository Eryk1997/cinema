<?php

declare(strict_types=1);

namespace App\Modules\Reservation\Api\Controller;

use App\Modules\Reservation\Api\Model\Create\CreateRequestModel;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/reservations', name: 'api_reservations_create', methods: ['POST'])]
class Create extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        CreateRequestModel $model,
        CommandBus $bus
    ): JsonResponse {
        try {
            $command = $model->toCreateReservationCommand();

            $bus->dispatch($command);

            return $this->successData($command->reservationId);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
