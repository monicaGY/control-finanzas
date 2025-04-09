<?php

namespace Spent\Application\Handler;

use Spent\Domain\Service\AddSpentService;

class AddSpentHandler
{
    public function __construct(
        private readonly AddSpentService $addSpent
    ){ }
    public function handle($spent): void
    {
        $this->addSpent->execute($spent);
    }


}
