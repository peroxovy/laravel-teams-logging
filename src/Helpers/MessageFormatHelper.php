<?php 

namespace Peroxovy\LaravelTeamsLogging\Helpers;

use Peroxovy\LaravelTeamsLogging\NotificationCards\DefaultNotificationCard;
use Peroxovy\LaravelTeamsLogging\NotificationCards\SimpleNotificationCard;

class MessageFormatHelper
{
    public static function getMessage(string $format = 'default', array $record = [])
    {
        switch($format)
        {
            case 'default':
                $card = new DefaultNotificationCard($record);
                return $card->getMessage();
                break;
            case 'simple':
                $card = new SimpleNotificationCard($record);
                return $card->getMessage();
                break;
            default:
                throw new \Exception("Message card format not found.");
        }
    }
}