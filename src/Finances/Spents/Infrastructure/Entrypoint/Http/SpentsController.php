<?php

namespace Spents\Infrastructure\Entrypoint\Http;
use Illuminate\Http\JsonResponse;
use Spents\Application\Handler\SpentsByMonthDiagramHandler;
use Spents\Application\Handler\SpentsByMonthHandler;
use Spents\Application\Transformer\TransformerSpentsByMonth;
use Spents\Application\Transformer\TransformerSpentsByMonthDiagram;
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
    public function getDiagramSpentsByMonth(): array
    {
        return (new SpentsByMonthDiagramHandler(
            new SmartcashSpentsByMonthRepository(),
            new TransformerSpentsByMonthDiagram(),
        ))->handle();
    }
}
