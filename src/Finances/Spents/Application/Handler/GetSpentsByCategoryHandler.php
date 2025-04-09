<?php

namespace Spents\Application\Handler;

use Spents\Application\Transformer\TransformerSpentsByCategoryDiagram;
use Spents\Domain\Service\GetSpentsService;

class GetSpentsByCategoryHandler
{
    public function __construct(
        private readonly GetSpentsService                   $spentsByCategory,
        private readonly TransformerSpentsByCategoryDiagram $transformer

    ){    }

    public function handle($year, $month): array
    {
        return$this->transformer->transform($this->spentsByCategory->execute($year, $month));
    }
}
