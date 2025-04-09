<?php

namespace Spents\Application\Handler;

use Spents\Application\Transformer\TransformerSpentsByDate;
use Spents\Domain\Service\GetSpentsService;

class GetSpentsByDateHandler
{
    public function __construct(
        private readonly GetSpentsService $getSpents,
        private readonly TransformerSpentsByDate $transformer
    ){    }

    public function handle($year, $month)
    {
        return $this->transformer->transform($this->getSpents->execute($year, $month));
    }
}
