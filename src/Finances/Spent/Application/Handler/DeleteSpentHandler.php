<?php

namespace Spent\Application\Handler;

use Spent\Domain\Service\DeleteSpentService;

class DeleteSpentHandler
{
    public function __construct(
        private readonly DeleteSpentService $deleteSpent
    ) {    }
    public function handle($id): void
    {
        $this->deleteSpent->execute($id);
    }
}
