<?php

namespace Arnissolle\Localization\Support;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;

class UrlGenerator extends BaseUrlGenerator
{
    /**
     * Get the URL to a named route.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @param bool $ignoreLocale
     * @return string
     *
     * @throws \Illuminate\Routing\Exceptions\UrlGenerationException
     */
    public function route($name, $parameters = [], $absolute = true, bool $ignoreLocale = false)
    {
        if ( ! $ignoreLocale) {

            $localizedRouteName = app()->getLocale() . '.' . $name;

            if ( ! is_null($route = $this->routes->getByName($localizedRouteName))) {
                return $this->toRoute($route, $parameters, $absolute);
            }
        }

        return parent::route($name, $parameters, $absolute);
    }
}