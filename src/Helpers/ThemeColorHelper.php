<?php

namespace Peroxovy\LaravelTeamsLogging\Helpers;

class ThemeColorHelper
{
    public static function getThemeColor(string $level = 'error')
    {
        switch($level){
            case 'debug' :
                return '01bc36';
                break;
            case 'info' :
                return '2986cc';
                break;
            case 'notice' :
                return '744700';
                break;
            case 'warning' :
                return 'ea9999';
                break;
            default :
                return 'f44336';
                break;
        }
    }
}