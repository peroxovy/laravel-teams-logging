<?php

namespace Peroxovy\LaravelTeamsLogging;

use Monolog\Processor\GitProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;
use Peroxovy\LaravelTeamsLogging\Handlers\TeamsLoggingHandler;

class TeamsLoggingLogger
{
    public function __invoke(array $config)
    {
        return new \Monolog\Logger(
            getenv('APP_NAME'), 
            [ 
                new TeamsLoggingHandler($config['level'], $config['method'], $config['format'], $config['webhooks'], $config['proxy']) 
            ], 
            [
                new MemoryUsageProcessor(), 
                new MemoryPeakUsageProcessor(), 
                new WebProcessor(), 
                new GitProcessor()
            ]);
    }
}