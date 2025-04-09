<?php

namespace Spent\Domain\Service;

use Spent\Domain\Model\SpentRepository;

class AddSpentService
{
    public function __construct(
        private readonly SpentRepository $repository
    ){    }

    public function execute($spent): void
    {
        $this->repository->add($spent);
    }
}
