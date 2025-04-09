<?php

namespace Spents\Domain\Model;

interface SpentsRepository
{
    public function get($year, $month);
}
