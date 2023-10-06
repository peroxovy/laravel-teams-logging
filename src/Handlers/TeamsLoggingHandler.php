<?php

namespace Peroxovy\LaravelTeamsLogging\Handlers;

class TeamsLoggingHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    public function __construct()
    {
        parent::__construct();
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

        app('TeamsLogging')->send($record['level'], $message);
    }
}