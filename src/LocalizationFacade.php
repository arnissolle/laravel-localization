<?php

namespace Arnissolle\Localization;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Arnissolle\Localization\Skeleton\SkeletonClass
 */
class LocalizationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'localization';
    }
}
