<?php

namespace Spents\Application\Transformer;

class TransformerSpentsByCategoryDiagram
{

    public function transform($spents): array
    {
        $result = [];
        foreach ($spents as $spent) {
            $categoryId = $spent['category-id'];
            if(!isset($result['cat-'.$categoryId])){

                $result['cat-'.$categoryId] = [
                    'category-id' => $categoryId,
                    'category' => $spent['category'],
                    'total' => array_reduce($spents, function ($carry, $item) use ($categoryId) {
                        if($item['category-id'] === $categoryId){
                            return $carry + $item['amount'];
                        }
                        return $carry;
                    }, 0)
                ];
            }
        }

        return array_values(array_filter($result, function($item) {
            return $item['total'] !== 0;
        }));
    }
}
