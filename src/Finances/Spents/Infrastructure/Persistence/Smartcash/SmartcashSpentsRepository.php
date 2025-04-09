<?php

namespace Spents\Infrastructure\Persistence\Smartcash;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spents\Domain\Model\LogSpent;
use Spents\Domain\Model\LogsSpents;
use Spents\Domain\Model\SpentsRepository;

class SmartcashSpentsRepository implements SpentsRepository
{
    private string $connection = 'smartcash';
    private const LOG = 'all_spents_by_user';
    private LogsSpents $logSpents;
    public function __construct()
    {
        $this->logSpents = new LogsSpents();
    }

    public function get($year, $month): array
    {
        if(!$year and !$month){
            $year  = Carbon::now()->year;
            $month = Carbon::now()->month;
        }

        $query = $this->query()
            ->where('l.user_id', Auth::user()->getAuthIdentifier())
            ->whereYear('date', $year);

        if($month){
            $query = $query
                ->whereMonth('date', $month);
        }
        $query->orderByDesc('l.date')
            ->get()->map(fn ($spent) => $this->createLog($spent));

        return $this->logSpents->getLogs();
    }

    private function createLog($spent): void
    {
        $this->logSpents->add(LogSpent::create($spent));
    }
    private function query(): Builder
    {
        return DB::connection($this->connection)
            ->table(self::LOG, 'l')
            ->select('c.name as categoryName', 'c.id as categoryId','c.color as iconColor', 'c.icon', 't.id as typeId', 't.name as typeName', 'l.amount', 'l.date', 'l.id')
            ->join('spent_categories as c', 'l.category_id', 'c.id')
            ->join('type_spents as t', 't.id','l.type_id')
            ->orderByDesc('l.date');
    }
}
