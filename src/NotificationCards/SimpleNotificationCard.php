<?php

namespace Peroxovy\LaravelTeamsLogging\NotificationCards;

use Peroxovy\LaravelTeamsLogging\Helpers\ThemeColorHelper;

class SimpleNotificationCard extends AbstractNotification
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function getMessage()
    {
        return [
            "@type" => "MessageCard",
            "@context" => "http://schema.org/extensions",
            "title" => getenv('APP_NAME') . ' - ' . $this->data['level_name'],
            "themeColor" => ThemeColorHelper::getThemeColor(strtolower($this->data["level_name"])),
            "summary" => $this->data["message"],
            "text" => "`" . $this->data["message"] . "`",
        ];
    }
}