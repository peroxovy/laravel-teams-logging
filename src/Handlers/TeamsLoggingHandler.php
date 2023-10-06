<?php

namespace Peroxovy\LaravelTeamsLogging\Handlers;

class TeamsLoggingHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    private $method;

    public function __construct($method = 'single')
    {
        parent::__construct();
        $this->method = $method;
    }

    protected function write(array $record): void
    {
        $message = [
            "@type" => "MessageCard",
            "@context" => "http://schema.org/extensions",
            "title" => $record['message'],
            "sections" => [
                [
                    "activityTitle" => $record['message'],
                ]
            ]
        ];

        $this->method = $this->method == 'split' ?: strtoupper($record['level_name']);

        if($this->method == 'split')
        {
            $this->method = strtoupper($record['level_name']);
        } else {
            $this->method = 'default';
        }

        app('TeamsLogging')->send($this->method, $message);
    }
}