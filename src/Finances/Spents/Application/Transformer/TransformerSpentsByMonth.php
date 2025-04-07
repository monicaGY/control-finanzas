<?php

namespace Spents\Application\Transformer;

use Illuminate\Http\JsonResponse;

class TransformerSpentsByMonth
{
    public function transform($result): JsonResponse
    {
        return response()->json(
            ['logSpents' => $result]
        );
    }
}
