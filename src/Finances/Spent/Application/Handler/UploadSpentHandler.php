<?php

namespace Spent\Application\Handler;

use Spent\Domain\Service\UploadSpentService;

class UploadSpentHandler
{
    public function __construct(
        private readonly UploadSpentService $uploadSpent
    ){    }

    public function handle($id, $spent): void
    {
        $this->uploadSpent->execute($id, $spent);
    }
}
