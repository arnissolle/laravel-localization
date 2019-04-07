# Laravel Localization

[![Build Status](https://travis-ci.org/arnissolle/laravel-localization.svg)](https://travis-ci.org/arnissolle/laravel-localization)
[![Total Downloads](https://poser.pugx.org/arnissolle/laravel-localization/d/total.svg)](https://packagist.org/packages/arnissolle/laravel-localization)
[![Latest Stable Version](https://poser.pugx.org/arnissolle/laravel-localization/v/stable.svg)](https://packagist.org/packages/arnissolle/laravel-localization)
[![License](https://poser.pugx.org/arnissolle/laravel-localization/license.svg)](https://packagist.org/packages/arnissolle/laravel-localization)

## Introduction

The Laravel Localization package is built for Laravel 5.8+ and provides: 

- [x] Localized routes with language URL prefixes.
- [ ] Domain based localized routes.
- [x] Middleware to detect user language based on HTTP header and session. 
- [x] Redirect the user to the localized version.
- [ ] Possibility to hide the language URL prefix for the default language.
- [ ] Possibility to localize a subset of routes only.
- [ ] Language Switcher and Hreflang Meta Tags
- [ ] Patched `route()` method to use localized routes whenever possible.
- [ ] Compatibility with `artisan route:cache`.

## Installation

To get started, use Composer to add the package to your project's dependencies:
```
composer require arnissolle/laravel-localization
```

Add the middleware to the `web` group in `App/Http/Kernel.php`:
```php
protected $middlewareGroups = [
    'web' => [
        // ...
        \Arnissolle\Localization\Middleware\Handler::class,
    ],
];
```
