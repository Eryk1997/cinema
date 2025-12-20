<?php

namespace App\Modules\Room\Api\Controller;

use App\Modules\Room\Api\Model\Update\UpdateRequestModel;
use App\Shared\Api\Controller\AbstractApiController;
use App\Shared\Infrastructure\Messenger\CommandBus\CommandBus;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[AsController]
#[IsGranted('ROLE_ADMIN')]
#[Route('/rooms/{id}', name: 'api_rooms_update', methods: ['PATCH'])]
class Update extends AbstractApiController
{
    public function __invoke(
        #[MapRequestPayload]
        UpdateRequestModel $model,
        CommandBus         $bus,
        string             $id,
    )
    {
        try {
            $command = $model->toUpdateRoomCommand($id);

            $bus->dispatch($command);

            return $this->successData($id);
        } catch (HandlerFailedException $exception) {
            return $this->successKnownIssueMessage($exception);
        }
    }
}
