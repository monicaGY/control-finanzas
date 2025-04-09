<?php

namespace Category\Application\Handler;

use Category\Domain\Service\GetCategoriesService;

class GetCategoriesHandler
{
    public function __construct(
        private readonly GetCategoriesService $getCategories
    ){    }

    public function handle()
    {
        return $this->getCategories->execute();
    }
}
