<?php

namespace Peroxovy\LaravelTeamsLogging\NotificationCards;

use Illuminate\Support\Facades\Auth;
use Peroxovy\LaravelTeamsLogging\Helpers\ThemeColorHelper;

class DefaultNotificationCard extends AbstractNotification
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
            "summary" => $this->data["message"],
            "themeColor" => ThemeColorHelper::getThemeColor(strtolower($this->data["level_name"])),
            "sections" => [
                [
                    "activityTitle" => '**Details:**',
                    "facts" => [
                        [
                            "name" => "message:",
                            "value" => '`' . $this->data["message"] . '`',
                        ],
                        [
                            "name" => "level:",
                            "value" => '`' . $this->data["level"] . '`',
                        ],
                        [
                            "name" => "level_name:",
                            "value" => '`' . $this->data["level_name"] . '`',
                        ],
                        [
                            "name" => "date_time:",
                            "value" => '`' . $this->data["datetime"]->format('Y-m-d H:i:s') . '`',
                        ],
                        [
                            "name" => "user_id:",
                            "value" => Auth::check() ? '`' . Auth::user()->id . '`' : '',
                        ],
                        [
                            "name" => "memory_usage:",
                            "value" => '`' . $this->data['extra']["memory_usage"] . '`',
                        ],
                        [
                            "name" => "memory_peak_usage:",
                            "value" => '`' . $this->data['extra']["memory_peak_usage"] . '`',
                        ],
                        [
                            "name" => "http_method:",
                            "value" => '`' . $this->data['extra']["http_method"] . '`',
                        ],
                        [
                            "name" => "server:",
                            "value" => '`' . $this->data['extra']["server"] . '`',
                        ],
                        [
                            "name" => "url:",
                            "value" => '`' . $this->data['extra']["url"] . '`',
                        ],
                        [
                            "name" => "ip:",
                            "value" => '`' . $this->data['extra']["ip"] . '`',
                        ],
                        [
                            "name" => "referrer:",
                            "value" => '`' . $this->data['extra']["referrer"] . '`',
                        ],
                        [
                            "name" => "unique_id:",
                            "value" => '`' . $this->data['extra']["unique_id"] . '`',
                        ],
                    ]
                ]
            ],
            "text" => "`" . $this->data["formatted"] . "`",
        ]; 
    }

}