<?php

namespace Peroxovy\LaravelTeamsLogging;

class TeamsLoggingSender
{
    private $logging_level;
    private $logging_method;
    private $webhooks;

    public function __construct($logging_level = 'all', $logging_method = 'single', $webhooks = [])
    {
        $this->logging_level = $logging_level;
        $this->logging_method = $logging_method;
        $this->webhooks = $webhooks;
    }

    public function send($sendTo, $message)
    {
        $json = json_encode($message);

        $ch = curl_init($this->webhooks[$sendTo]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);

        $result = curl_exec($ch);

        if (curl_error($ch)) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }
        if ($result !== "1") {
            throw new \Exception('Error response: ' . $result);
        }
    }
}