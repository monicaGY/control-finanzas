<?php

namespace Spents\Application\Handler;

use Illuminate\Support\Carbon;
use Spents\Application\Transformer\TransformerSpentsByMonthDiagram;
use Spents\Domain\Service\GetSpentsService;

class GetSpentByTypeHandler
{
    public function __construct(
        private readonly GetSpentsService       $getSpentsByType,
        private readonly TransformerSpentsByMonthDiagram $transformer)
    { }

    public function handle($year, $month): array
    {
        if(!$year and !$month){
            $title = Carbon::now()->format('F Y');
        }else if($month and $year){
            $monthName = Carbon::createFromDate(null, $month, 1)->format('F');
            $title = $monthName.' '.$year;
        }else {
            $title = $year;
        }

        return $this->transformer->transform($title, $this->getSpentsByType->execute($year, $month));
    }
}
