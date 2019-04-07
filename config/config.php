<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Locales Configuration
    |--------------------------------------------------------------------------
    |
    | Add any language you want to support.
    |
    */

    'locales' => [
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_US'],
        'fr' => ['name' => 'French', 'script' => 'Latn', 'native' => 'Français', 'regional' => 'fr_FR'],
    ],

    /*
    |--------------------------------------------------------------------------
    | URL's Default Locale Visibility
    |--------------------------------------------------------------------------
    |
    | Default locale will not be shown in the url...
    | If enabled and 'en' is the default language: / -> English page, /fr -> French page
    | If disabled: /en -> English Page, /fr -> French page
    |
    */

    'hide_default_locale_in_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Locale Query Parameter
    |--------------------------------------------------------------------------
    |
    | Use query parameter if there are no localized routes available.
    | Set it to null to disable usage of query parameter.
    |
    */

    'locale_query_parameter' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Localized Route Redirection
    |--------------------------------------------------------------------------
    |
    | Enable redirect if there is a localized route available and the user
    | locale was detected (via HTTP header or session).
    |
    */

    'redirect_to_localized_route' =>  true,

    /*
    |--------------------------------------------------------------------------
    | User Locale Detection via Accept-Language Header
    |--------------------------------------------------------------------------
    |
    | Try to detect user locale via Accept-Language header.
    |
    */

    'detect_via_http_header' => true,

    /*
    |--------------------------------------------------------------------------
    | User Locale Detection via Session
    |--------------------------------------------------------------------------
    |
    | Remember the user locale using session.
    |
    */

    'detect_via_session' => true,

];
