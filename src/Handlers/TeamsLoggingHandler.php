<?php

namespace Peroxovy\LaravelTeamsLogging\Handlers;

use Peroxovy\LaravelTeamsLogging\Helpers\LevelPriorityHelper;
use Peroxovy\LaravelTeamsLogging\Helpers\MessageFormatHelper;
use Peroxovy\LaravelTeamsLogging\TeamsLoggingSender;

class TeamsLoggingHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    public $lvl;
    public $method;
    public $format;
    public $webhooks;
    public $proxy;

    public function __construct(string $lvl = 'debug', string $method = 'default', string $format = 'default', array $webhooks = [], array $proxy = [])
    {
        parent::__construct();
        $this->lvl = strtolower($lvl);
        $this->method = $method;
        $this->format = $format;
        $this->webhooks = $webhooks;
        $this->proxy = $proxy;
    }

    protected function validateWebhook(string $levelName): string|null
    {

        if($this->method !== 'default' && $this->method !== 'split')
        {
            throw new \Exception("Webhook sending method not supported. Must be [default or split].");
        }

        if($this->method == 'default')
        {
            if(!array_key_exists('default', $this->webhooks))
            {
                throw new \Exception("Webhook variable for [default] is not defined in .env or configuration file.");
            } else {
                if($this->webhooks['default'] == null) {
                    throw new \Exception("Webhook [default] URL value is not defined in .env or configuration file.");
                } else {
                    return $this->webhooks['default'];
                }
            }
        }

        if($this->method == 'split')
        {
            if(!array_key_exists($this->lvl, $this->webhooks))
            {
                throw new \Exception("Webhook variable for [". $this->lvl ."] is not defined in .env or configuration file.");
            } else {
                if($this->webhooks[$this->lvl] == null) {
                    throw new \Exception("Webhook [" . $this->lvl . "] URL value is not defined in .env or configuration file.");
                } else {
                    unset($this->webhooks['default']);

                    return $this->webhooks[strtolower($levelName)];
                }
            }
        }
    }

    protected function write(array $record): void
    {
        $webhookUrl = $this->validateWebhook($record['level_name']);

        if($webhookUrl !== null && LevelPriorityHelper::shouldSendMessage($this->lvl, strtolower($record['level_name'])))
        {
            $message = MessageFormatHelper::getMessage($this->format, $record);
            $logging = new TeamsLoggingSender($webhookUrl, $this->proxy);
            $logging->send($message);
        }
    }
}
