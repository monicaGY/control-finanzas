<?php

namespace Spents\Domain\Service;

use Spents\Domain\Model\SpentsRepository;

class GetSpentsService
{
    public function __construct(
        private readonly SpentsRepository $repository
    ){    }

    public function execute($year, $month)
    {
        return $this->repository->get($year, $month);
    }
}
