<?php

namespace Peroxovy\LaravelTeamsLogging\Helpers;

class TeamsPriorityHelper
{
    public static function priority(string $priority) : int
    {
        $priorities = [
            'debug' => 0,
            'info' => 1,
            'notice' => 2,
            'warning' => 3,
            'error' => 4,
            'critical' => 5,
            'alert' => 6,
            'emergency' => 7,
        ];

        return $priorities[$priority] ?? null;
    }
}