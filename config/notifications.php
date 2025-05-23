<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dark mode
    |--------------------------------------------------------------------------
    |
    | By enabling this setting, your notifications will be ready for Tailwind's
    | Dark Mode feature.
    |
    | https://tailwindcss.com/docs/dark-mode
    |
    */

    'dark_mode' => true,

    /*
    |--------------------------------------------------------------------------
    | Database notifications
    |--------------------------------------------------------------------------
    |
    | By enabling this feature, your users are able to open a slide-over within
    | the app to view their database notifications.
    |
    */

    'database' => [
        'enabled' => true,
        'trigger' => 'notifications.database-notifications-trigger',
        'polling_interval' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | This is the configuration for the general layout of notifications.
    |
    */

    'layout' => [
        'alignment' => [
            'horizontal' => 'right',
            'vertical' => 'top',
        ],
    ],

];
