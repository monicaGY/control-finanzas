<?php

namespace Spent\Infrastructure\Entrypoint\Http;

use App\Http\Requests\AddSpentRequest;
use App\Http\Requests\UploadSpentRequest;
use Spent\Application\Handler\AddSpentHandler;
use Spent\Application\Handler\DeleteSpentHandler;
use Spent\Application\Handler\UploadSpentHandler;
use Spent\Domain\Service\AddSpentService;
use Spent\Domain\Service\DeleteSpentService;
use Spent\Domain\Service\UploadSpentService;
use Spent\Infrastructure\Persistence\Smartcash\SmartcashSpentRepository;

class SpentController
{
    public function deleteSpent($id): void
    {
        (new DeleteSpentHandler(
            new DeleteSpentService(
                new SmartcashSpentRepository()
            )
        ))->handle($id);
    }
    public function uploadSpent($id, UploadSpentRequest $request): void
    {
        (new UploadSpentHandler(
            new UploadSpentService(
                new SmartcashSpentRepository()
            )
        ))->handle($id, $request->validated());
    }
    public function add(AddSpentRequest $request): void
    {
        (new AddSpentHandler(
            new AddSpentService(
                new SmartcashSpentRepository()
            )
        ))->handle($request->validated());
    }

}
