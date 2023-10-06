<?php

namespace Peroxovy\LaravelTeamsLogging\Handlers;

use Peroxovy\LaravelTeamsLogging\Helpers\TeamsPriorityHelper;

class TeamsLoggingHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    private $level;
    private $method;

    public function __construct($level = 'debug', $method = 'single')
    {
        parent::__construct();
        $this->level = $level;
        $this->method = $method;
    }

    protected function getMessage(array $record) : array
    {
        return [
            "@type" => "MessageCard",
            "@context" => "http://schema.org/extensions",
            "title" => getenv('APP_NAME') . ' - ' . $record['level_name'],
            "sections" => [
                [
                    "activityTitle" => 'Details:',
                    "facts" => [
                        [
                            "name" => "**Formatted error:",
                            "value" => '`' . $record["formatted"] . '`',
                        ]
                    ]
                ]
            ]
        ];
    }

    protected function getMethod(string $levelName) : string
    {
        if($this->method == 'split')
        {
            $method = strtolower($levelName);
        } else {
            $method = 'default';
        }

        return $method;
    }

    protected function write(array $record): void
    {
        if($this->level >= TeamsPriorityHelper::priority($this->level))
        {
            $method = $this->getMethod($record['level_name']);
            $message = $this->getMessage($record);
            app('TeamsLogging')->send($method, $message);
        }
    }
}