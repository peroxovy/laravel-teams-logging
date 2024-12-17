<?php

return [
    /**
     *  Set the level of logging. Available levels: 
     *  [debug, info, notice, warning, error, critical, alert, emergency].
     */
    'teams_logging_level' => env('TEAMS_LOGGING_LEVEL', 'debug'),

    /**
     * Method of logging:
     * - single: need to define "TEAMS_LOGGING_WEBHOOK_DEFAULT" and sends notification only to the DEFAULT channel specified.
     * - split: need to define "TEAMS_LOGGING_WEBHOOK_[$level]" for each of desired channels.
     */
    'teams_logging_method' => env('TEAMS_LOGGING_METHOD', 'single'),

    /**
     * Format of logging:
     *  - default: logs full details of occured error,
     *  - simple: logs only message from occured error.
     */
    'teams_logging_format' => env('TEAMS_LOGGING_FORMAT', 'default'),

    /**
     * Teams Webhook URL for the default channel.
     */
    'teams_logging_webhook_default' => env('TEAMS_LOGGING_WEBHOOK_DEFAULT', null),

    /**
     * Teams webhook URL for the debug channel.
     */
    'teams_logging_webhook_debug' => env('TEAMS_LOGGING_WEBHOOK_DEBUG', null),

    /**
     * Teams webhook URL fot the info channel.
     */
    'teams_logging_webhook_info' => env('TEAMS_LOGGING_WEBHOOK_INFO', null),

    /**
     * Teams webhook URL fot the notice channel.
     */
    'teams_logging_webhook_notice' => env('TEAMS_LOGGING_WEBHOOK_NOTICE', null),

    /**
     * Teams webhook URL fot the warning channel.
     */
    'teams_logging_webhook_warning' => env('TEAMS_LOGGING_WEBHOOK_WARNING', null),

    /**
     * Teams webhook URL fot the error channel.
     */
    'teams_logging_webhook_error' => env('TEAMS_LOGGING_WEBHOOK_ERROR', null),

    /**
     * Teams webhook URL fot the critical channel.
     */
    'teams_logging_webhook_critical' => env('TEAMS_LOGGING_WEBHOOK_CRITICAL', null),

    /**
     * Teams webhook URL fot the alert channel.
     */
    'teams_logging_webhook_alert' => env('TEAMS_LOGGING_WEBHOOK_ALERT', null),

    /**
     * Teams webhook URL fot the emergency channel.
     */
    'teams_logging_webhook_emergency' => env('TEAMS_LOGGING_WEBHOOK_EMERGENCY', null),

    /**
     * Proxy URL - if it's set check if authentication to proxy is needed.
     */
    'teams_logging_proxy_url' => env('TEAMS_LOGGING_PROXY_URL', null),

    /**
     * Proxy User - required if authentication to proxy is needed.
     */
    'teams_logging_proxy_user' => env('TEAMS_LOGGING_PROXY_USER', null),

    /**
     * Proxy Password - required if authentication to proxy is needed.
     */
    'teams_logging_proxy_password' => env('TEAMS_LOGGING_PROXY_PASSWORD', null)

    
];