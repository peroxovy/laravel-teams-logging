<?php

namespace Peroxovy\LaravelTeamsLogging\NotificationCards;

use Peroxovy\LaravelTeamsLogging\MessageInterface;

abstract class AbstractNotification implements MessageInterface
{
    public $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    abstract public function getMessage();
}