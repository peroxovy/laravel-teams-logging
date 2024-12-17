<?php

namespace Peroxovy\LaravelTeamsLogging;

class TeamsLoggingSender
{
    private $webhookUrl;
    private $proxy;

    public function __construct(string $webhookUrl = null, array $proxy = [])
    {
        $this->webhookUrl = $webhookUrl;
        $this->proxy = $proxy;
    }

    public function send($message)
    {
        $json = json_encode($message);
        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);

        if (!empty($this->proxy['url'])) {
            curl_setopt($ch, CURLOPT_PROXY, $this->proxy['url']);
            
            if (!empty($this->proxy['user']) && !empty($this->proxy['password'])) {
                $proxyUserPwd = $this->proxy['user'] . ':' . $this->proxy['password'];
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyUserPwd);
            }
        }

        $result = curl_exec($ch);

        if (curl_error($ch)) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }
        if ($result !== "1") {
            throw new \Exception('Error response: ' . $result);
        }
    }
}