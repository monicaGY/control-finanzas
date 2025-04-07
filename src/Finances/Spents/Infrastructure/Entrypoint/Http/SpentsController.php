<?php

namespace Spents\Infrastructure\Entrypoint\Http;
use Illuminate\Http\JsonResponse;
use Spents\Application\Handler\SpentsByMonthHandler;
use Spents\Application\Transformer\TransformerSpentsByMonth;
use Spents\Infrastructure\Persistence\Smartcash\SmartcashSpentsByMonthRepository;

class SpentsController
{
    public function getByDate(): JsonResponse
    {
        return (new SpentsByMonthHandler(
            new SmartcashSpentsByMonthRepository(),
            new TransformerSpentsByMonth(),
        ))->handle();
    }
}
