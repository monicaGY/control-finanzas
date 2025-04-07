<?php

namespace Spents\Domain\Service;

use Illuminate\Support\Carbon;

interface SpentsByMonthRepository
{
    public function execute(Carbon $date = null);

}
