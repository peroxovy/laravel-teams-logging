<?php

namespace Peroxovy\LaravelTeamsLogging;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class TeamsLoggingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if($this->app instanceof \Illuminate\Foundation\Application){
            $config = __DIR__ . '/../config/teams-logging.php';
            $this->publishes([$config => config_path('teams-logging.php')],'config');
        }
    }

    public function register() 
    {
        if($this->app instanceof \Illuminate\Foundation\Application){
            $config = __DIR__ . '/../config/teams-logging.php';
            $this->mergeConfigFrom($config,'teams-logging');
        }

        $this->app->bind('TeamsLogging', function (){
            $teams_logging_level = getenv('TEAMS_LOGGING_LEVEL') ?: $this->app->config->get('teams-logging.teams_logging_level', 'all');
            $teams_logging_method = getenv('TEAMS_LOGGING_METHOD') ?: $this->app->config->get('teams-logging.teams_logging_method', 'single');
            $webhooks['default'] = getenv('TEAMS_LOGGING_WEBHOOK_DEFAULT') ?: $this->app->config->get('teams-logging.teams_logging_webhook_default', null);
            $webhooks['debug'] = getenv('TEAMS_LOGGING_WEBHOOK_DEBUG') ?: $this->app->config->get('teams-logging.teams_logging_webhook_debug', null);
            $webhooks['info'] = getenv('TEAMS_LOGGING_WEBHOOK_INFO') ?: $this->app->config->get('teams-logging.teams_logging_webhook_info', null);
            $webhooks['notice'] = getenv('TEAMS_LOGGING_WEBHOOK_NOTICE') ?: $this->app->config->get('teams-logging.teams_logging_webhook_notice', null);
            $webhooks['warning'] = getenv('TEAMS_LOGGING_WEBHOOK_WARNING') ?: $this->app->config->get('teams-logging.teams_logging_webhook_warning', null);
            $webhooks['error'] = getenv('TEAMS_LOGGING_WEBHOOK_ERROR') ?: $this->app->config->get('teams-logging.teams_logging_webhook_error', null);
            $webhooks['critical'] = getenv('TEAMS_LOGGING_WEBHOOK_CRITICAL') ?: $this->app->config->get('teams-logging.teams_logging_webhook_critical', null);
            $webhooks['alert'] = getenv('TEAMS_LOGGING_WEBHOOK_ALERT') ?: $this->app->config->get('teams-logging.teams_logging_webhook_alert', null);
            $webhooks['emergency'] = getenv('TEAMS_LOGGING_WEBHOOK_EMERGENCY') ?: $this->app->config->get('teams-logging.teams_logging_webhook_emergency', null);
            $teams_logging_proxy_url = getenv('TEAMS_LOGGING_PROXY_URL') ?: $this->app->config->get('teams-logging.teams_logging_proxy_url', null);
            $teams_logging_proxy_user = getenv('TEAMS_LOGGING_PROXY_USER') ?: $this->app->config->get('teams-logging.teams_logging_proxy_user', null);
            $teams_logging_proxy_password = getenv('TEAMS_LOGGING_PROXY_PASSWORD') ?: $this->app->config->get('teams-logging.teams_logging_proxy_password', null);
        
            return new \Peroxovy\LaravelTeamsLogging\TeamsLoggingSender(
                $teams_logging_level,
                $teams_logging_method,
                $webhooks,
                $teams_logging_proxy_url,
                $teams_logging_proxy_user,
                $teams_logging_proxy_password
            );
        });

        $this->app->alias('TeamsLogging', 'Peroxovy\LaravelTeamsLogging\TeamsSender');
    }
}