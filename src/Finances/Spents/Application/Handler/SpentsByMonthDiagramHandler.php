<?php

namespace Spents\Application\Handler;

use Spents\Application\Transformer\TransformerSpentsByMonthDiagram;
use Spents\Infrastructure\Persistence\Smartcash\SmartcashSpentsByMonthRepository;

class SpentsByMonthDiagramHandler
{
    public function __construct(
        private readonly SmartcashSpentsByMonthRepository $getSpentsByMonth,
        private readonly TransformerSpentsByMonthDiagram $transformer,
    ){    }

    public function handle($date = null): array
    {
        return $this->transformer->transform($this->getSpentsByMonth->execute($date));
    }
}
