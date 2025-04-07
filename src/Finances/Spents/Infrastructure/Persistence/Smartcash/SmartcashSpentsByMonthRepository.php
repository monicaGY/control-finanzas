<?php

namespace Spents\Infrastructure\Persistence\Smartcash;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spents\Domain\Model\LogSpent;
use Spents\Domain\Model\LogsSpents;
use Spents\Domain\Service\SpentsByMonthRepository;
use Illuminate\Support\Carbon;

class SmartcashSpentsByMonthRepository implements SpentsByMonthRepository
{

    private string $connection = 'smartcash';
    private const LOG = 'all_spents_by_user';
    private LogsSpents $logSpents;

    public function __construct()
    {
        $this->logSpents = new LogsSpents();
    }

    public function execute(Carbon $date = null)
    {
        if($date === null){
            $date = Carbon::now();
        }

        $this->query()
            ->where('l.user_id', Auth::user()->getAuthIdentifier())
            ->whereMonth('date', $date->format('m'))
            ->whereYear('date', $date->format('Y'))
            ->orderByDesc('l.date')
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
            ->select('c.name as categoryName', 'c.id as categoryId','c.color as iconColor', 'c.icon', 't.id as typeId', 't.name as typeName', 'l.amount', 'l.date')
            //->select('l.amount', 'l.date','c.name as category', 't.name as type')
            ->join('spent_categories as c', 'l.category_id', 'c.id')
            ->join('type_spents as t', 't.id','l.type_id')
            ->orderByDesc('l.date');
    }
}
