<?php

namespace Peroxovy\LaravelTeamsLogging;

use Peroxovy\LaravelTeamsLogging\Handlers\TeamsLoggingHandler;

class TeamsLoggingLogger
{
    public function __invoke(array $config)
    {
        return new \Monolog\Logger(
            getenv('APP_NAME'), 
            [ 
                new TeamsLoggingHandler($config['method']) 
            ], 
            [

            ]);
    }
}