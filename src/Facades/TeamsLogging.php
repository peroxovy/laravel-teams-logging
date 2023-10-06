<?php

namespace Peroxovy\LaravelTeamsLogging\Facades;

use Illuminate\Support\Facades\Facade;

class TeamsLogging extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TeamsLogging';
    }
}