<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Locales
    |--------------------------------------------------------------------------
    |
    | Add any language you want to support
    |
    */
    'locales' => [
        'en' => ['code' => 'en_GB', 'name' => 'English', 'localized_name' => 'English'],
        'fr' => ['code' => 'fr_FR', 'name' => 'French', 'localized_name' => 'Français'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hide default locale in the url
    |--------------------------------------------------------------------------
    |
    | If enabled and 'en' is the default language:
    | / -> English page, /de -> German page
    | If disabled:
    | /en -> English Page, /fr -> French page
    |
    */
    'hide_default_locale_in_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Locale query parameter
    |--------------------------------------------------------------------------
    |
    | Use query parameter if there are no localized routes available.
    | Set it to null to disable usage of query parameter.
    |
    */
    'locale_query_parameter' => 'hl',

    /*
    |--------------------------------------------------------------------------
    | Redirect to localized route
    |--------------------------------------------------------------------------
    |
    | Enable redirect if there is a localized route available and the user
    | locale was detected (via HTTP header or session)
    |
    */
    'redirect_to_localized_route' =>  true,

    /*
    |--------------------------------------------------------------------------
    | Detect locale via HTTP header
    |--------------------------------------------------------------------------
    |
    | Try to detect user locale via Accept-Language header.
    |
    */
    'detect_via_http_header' => true,

    /*
    |--------------------------------------------------------------------------
    | Detect locale via session
    |--------------------------------------------------------------------------
    |
    | Remember the user locale using session.
    |
    */
    'detect_via_session' => true,

];
