<?php

namespace Spents\Application\Transformer;

class TransformerSpentsByCategoryDiagram
{

    public function transform($spents): array
    {
        $result = [];
        foreach ($spents as $spent) {
            $typeId = $spent['type-id'];
            $categoryId = $spent['category-id'];
            $index = 'type-'.$typeId.'cat-'.$categoryId;
            if(!isset($result[$index])){

                $result[$index] = [
                    'type-id' => $typeId,
                    'category-id' => $categoryId,
                    'category' => $spent['category'],
                    'total' => array_reduce($spents, function ($carry, $item) use ($categoryId) {
                        if($item['category-id'] === $categoryId){
                            return $carry + $item['amount'];
                        }
                        return $carry;
                    }, 0),
                    'iconColor' => $spent['iconColor'],
                ];
            }
        }

        return array_values(array_filter($result, function($item) {
            return $item['total'] !== 0;
        }));
    }
}
