<?php

namespace Category\Infrastructure\Entrypoint\Http;

use Category\Application\Handler\GetCategoriesHandler;
use Category\Domain\Service\GetCategoriesService;
use Category\Infrastructure\Persistence\Smartcash\SmartcashCategoryRepository;

class CategoryController
{
    public function getAllCategories()
    {
        return (new GetCategoriesHandler(
            new GetCategoriesService(
                new SmartcashCategoryRepository()
            )
        ))->handle();
    }
}
