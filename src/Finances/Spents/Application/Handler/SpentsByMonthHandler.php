<?php

namespace Spents\Application\Handler;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Spents\Application\Transformer\TransformerSpentsByMonth;
use Spents\Domain\Service\SpentsByMonthRepository;

class SpentsByMonthHandler
{
    public function __construct(
        private readonly SpentsByMonthRepository $spentsByMonth,
        private readonly TransformerSpentsByMonth $transformer
    ){    }

    public function handle(Carbon $date = null): JsonResponse
    {

        return $this->transformer->transform($this->spentsByMonth->execute($date));
    }
}
