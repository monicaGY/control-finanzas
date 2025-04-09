<?php

namespace Spents\Domain\Model;


use Illuminate\Support\Carbon;

class LogSpent
{
    public function __construct(
        private readonly int $id,
        private readonly int $categoryId,
        private readonly string $category,
        private readonly int $typeId,
        private readonly string $type,
        private readonly string $date,
        private readonly float  $amount,
        private readonly string $icon,
        private readonly string $iconColor,
    ){    }

    public static function create($spent): LogSpent
    {
        return new self(
            $spent->id,
            $spent->categoryId,
            $spent->categoryName,
            $spent->typeId,
            $spent->typeName,
            $spent->date,
            $spent->amount,
            $spent->icon,
            $spent->iconColor,
        );
    }

    public function date(): string
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'type' => $this->type,
            'date' => $this->date(),
            'amount' => $this->amount,
            'icon' => $this->icon,
            'iconColor' => $this->iconColor,
            'category-id' => $this->categoryId,
            'type-id' => $this->typeId,
        ];
    }

}
