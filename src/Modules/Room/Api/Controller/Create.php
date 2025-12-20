<?php

namespace App\Modules\Room\Api\Controller;

use App\Modules\Room\Api\Model\Create\CreateRequestModel;
use App\Modules\Room\Domain\Entity\Room;
use App\Modules\Room\Domain\ValueObject\RoomId;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
#[IsGranted('ROLE_ADMIN')]
#[Route('/rooms', name: 'api_rooms_create', methods: ['POST'])]
class Create extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        CreateRequestModel $model,
        CommandBus $bus,
    ): JsonResponse
    {
        try {
            $command = $model->toCreateRoomCommand();

            $bus->dispatch($command);

        return $this->successData($command->roomId);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
