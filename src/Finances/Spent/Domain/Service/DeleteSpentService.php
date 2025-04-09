<?php

namespace Spent\Domain\Service;

use Spent\Domain\Model\SpentRepository;

class DeleteSpentService
{
    public function __construct(
        private readonly SpentRepository $repository
    ){    }

    public function execute($id): void
    {
        $this->repository->delete($id);
    }
}
