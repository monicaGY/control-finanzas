<?php

namespace Spent\Infrastructure\Persistence\Smartcash;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spent\Domain\Model\SpentRepository;

class SmartcashSpentRepository implements SpentRepository
{
    private string $connection = 'smartcash';
    private const TABLE_SPENTS = 'all_spents_by_user';
    public function delete(int $id): void
    {
        DB::connection($this->connection)
            ->table(self::TABLE_SPENTS)
            ->where('id', $id)
            ->delete();
    }

    public function update(int $id, array $spent): void
    {
        DB::connection($this->connection)
            ->table(self::TABLE_SPENTS)
            ->where('id', $id)
            ->update([
                'amount' => $spent['amount']
            ]);
    }

    public function add($spent): void
    {
        DB::connection($this->connection)
            ->table(self::TABLE_SPENTS)
            ->insert([
                'amount' => $spent['amount'],
                'user_id' => Auth::user()->getAuthIdentifier(),
                'user_name' => Auth::user()->name,
                'type_id' => $spent['type'],
                'category_id' => $spent['category'],
                'date' => Carbon::parse($spent['date'])->format('Y-m-d'),
            ]);
    }
}
