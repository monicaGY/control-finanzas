<?php

namespace Spents\Domain\Model;

class LogsSpents
{
    private array $logs = [];
    public function add(LogSpent $logSpent){
        $this->logs[] = $logSpent;
    }
    public function getLogs(): array
    {
        return array_map(function($log) {
            return $log->toArray();
        }, $this->logs);
    }

}
