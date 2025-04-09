<?php

namespace Category\Infrastructure\Persistence\Smartcash;

use Category\Domain\Model\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmartcashCategoryRepository implements CategoryRepository
{
    private string $connection = 'smartcash';
    private const CATEGORIES = 'spent_categories';
    private const CATEGORIES_DEFAULT = 'web';
    public function getAll()
    {
        return DB::connection($this->connection)
            ->table(self::CATEGORIES)
            ->where('user', self::CATEGORIES_DEFAULT)
            ->orWhere('user', Auth::user()->getAuthIdentifier())
            ->get()->map(fn ($category) => $this->createCategory($category));
    }
    private function createCategory($category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'icon' => $category->icon,
            'iconColor' => $category->color,
        ];
    }
}
