<?php

namespace Spent\Domain\Service;

use Spent\Domain\Model\SpentRepository;

class UploadSpentService
{
    public function __construct(
        private readonly SpentRepository $spentRepository
    ){    }

    public function execute($id, $spent): void
    {
        $this->spentRepository->update($id, $spent);
    }
}
