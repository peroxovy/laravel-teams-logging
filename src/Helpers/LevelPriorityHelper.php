<?php

namespace Peroxovy\LaravelTeamsLogging\Helpers;

class LevelPriorityHelper
{
    public static function shouldSendMessage(string $debugLevel, string $messageLevel) : int
    {
        $priority = [
            'debug' => 8,
            'info' => 7,
            'notice' => 6,
            'warning' => 5,
            'error' => 4,
            'critical' => 3,
            'alert' => 2,
            'emergency' => 1
        ];

        $toSend = $priority[$debugLevel] >= $priority[$messageLevel] ? true : false; 
        
        return $toSend;
    }
}