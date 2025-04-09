<?php

namespace Spents\Infrastructure\Entrypoint\Http;
use Spents\Application\Handler\GetSpentByTypeHandler;
use Spents\Application\Handler\GetSpentsByCategoryHandler;
use Spents\Application\Handler\GetSpentsByDateHandler;
use Spents\Application\Handler\SpentsByMonthDiagramHandler;
use Spents\Application\Transformer\TransformerSpentsByCategoryDiagram;
use Spents\Application\Transformer\TransformerSpentsByDate;
use Spents\Application\Transformer\TransformerSpentsByMonthDiagram;
use Spents\Domain\Service\GetSpentsService;
use Spents\Infrastructure\Persistence\Smartcash\SmartcashSpentsByMonthRepository;
use Spents\Infrastructure\Persistence\Smartcash\SmartcashSpentsRepository;

class SpentsController
{
    public function getByDate($year = null, $month = null)
    {
        return (new GetSpentsByDateHandler(
            new GetSpentsService(
                new SmartcashSpentsRepository()
            ),
            new TransformerSpentsByDate()
        ))->handle($year, $month);
    }
    public function getDiagramSpentsByMonth(): array
    {
        return (new SpentsByMonthDiagramHandler(
            new SmartcashSpentsByMonthRepository(),
            new TransformerSpentsByMonthDiagram(),
        ))->handle();
    }
    public function getSpentsByType($year = null, $month = null): array
    {
        return (new GetSpentByTypeHandler(
            new GetSpentsService(
                new SmartcashSpentsRepository()
            ),
            new TransformerSpentsByMonthDiagram(),
        ))->handle($year, $month);
    }
    public function getSpentsByCategory($year = null, $month = null): array
    {
        return (new GetSpentsByCategoryHandler(
            new GetSpentsService(
                new SmartcashSpentsRepository()
            ),
            new TransformerSpentsByCategoryDiagram()
        ))->handle($year, $month);
    }
}
