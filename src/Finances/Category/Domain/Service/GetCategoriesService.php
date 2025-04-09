<?php

namespace Category\Domain\Service;

use Category\Domain\Model\CategoryRepository;

class GetCategoriesService
{
    public function __construct(
        private readonly CategoryRepository $repository
    ){    }
    public function execute()
    {
        return $this->repository->getAll();
    }
}
