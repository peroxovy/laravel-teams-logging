<?php 

namespace Peroxovy\LaravelTeamsLogging\NotificationCards;

use Peroxovy\LaravelTeamsLogging\MessageInterface;

class CustomNotificationCard implements MessageInterface
{
    private string $title;
    private string $text;
    private array $sections;
    private string $summary;
    private string $themeColor;

    public function __construct(string $title = 'This is generic title.', string $text = 'This is generic message text.', string $summary = 'This is generic summary.')
    {
        $this->title = $title;
        $this->text = $text;
        $this->summary = $summary;
    }

    public function setTitle(string $title): CustomNotificationCard
    {
        $this->title = $title;

        return $this;
    }

    public function setText(string $text): CustomNotificationCard
    {
        $this->text = $text;

        return $this;
    }

    public function addFact(string $title, string $name, string $value): CustomNotificationCard
    {
        if (!isset($this->sections[0]) || !isset($this->sections[0]['facts'])) {
            $section = ['activityTitle' => $title];
            $this->sections[] = $section;
        }
    
        if (!is_null($name) && !is_null($value)) {
            $fact = ['name' => $name, 'value' => $value];
            $this->sections[0]['facts'][] = $fact;
        }
    
        return $this;
    }

    public function setSummary(string $summary): CustomNotificationCard
    {
        $this->summary = $summary;

        return $this;
    }

    public function setThemeColor(string $themeColor): CustomNotificationCard
    {
        $this->themeColor = $themeColor;

        return $this;
    }

    public function getMessage()
    {
        $message = [
            "@type" => "MessageCard",
            "@context" => "http://schema.org/extensions",
        ];

        if(isset($this->title)) {
            $message["title"] = $this->title;
        }

        if(isset($this->text)) {
            $message["text"] = $this->text;
        }
        
        if(isset($this->sections)) {
            $message["sections"] = $this->sections;
        }

        if(isset($this->summary)) {
            $message["summary"] = $this->summary;
        }

        if(isset($this->themeColor)) {
            $message["themeColor"] = $this->themeColor;
        }

        return $message;
    }
}