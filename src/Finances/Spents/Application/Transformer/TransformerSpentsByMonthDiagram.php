<?php

namespace Spents\Application\Transformer;

class TransformerSpentsByMonthDiagram
{
    private const EXPENSES = 1;
    private const INCOME = 2;
    public function transform($title, array $spents):array
    {
        $expenses = $this->calculateTotalSpents($spents, self::EXPENSES);
        $income = $this->calculateTotalSpents($spents, self::INCOME);
        return [
            'month' => $title,
            'labels' => ['Expenses', 'Incomes'],
            'data' => [$expenses, $income],
        ];
    }
    private function calculateTotalSpents($spents, $type): float
    {
        return array_reduce($spents, function($carry, $item) use ($type) {
            if ($item['type-id'] === $type) {
                return $carry + $item['amount'];
            }
            return $carry;
        }, 0);
    }
}
