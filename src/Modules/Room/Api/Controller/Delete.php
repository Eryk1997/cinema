<?php

namespace App\Modules\Room\Api\Controller;

use App\Modules\Room\Application\Messenger\Command\DeleteRoom\DeleteRoomCommand;
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
#[Route('/rooms/{id}', name: 'api_rooms_delete', methods: ['DELETE'])]
class Delete extends AbstractApiController
{
    public function __invoke(
        CommandBus $bus,
        string $id
    ): JsonResponse
    {
        try {
            $bus->dispatch(new DeleteRoomCommand($id));

            return $this->successData($id);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
