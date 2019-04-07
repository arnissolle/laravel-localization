<?php

namespace Arnissolle\Localization\Middleware;

use Illuminate\Http\Request;
use Closure;

class LocalizationHandler
{
    /**
     * Handle an incoming request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() === 'GET')
        {
            $locale = $request->segment(1);
            $fallback_locale = config('app.fallback_locale');
            $locales = config('app.locales', [$fallback_locale]);
            $preferred_locale = $request->getPreferredLanguage($locales);

            if ( ! in_array($locale, $locales)) {

                $locale = session('locale') ?: $preferred_locale;
                $path = $this->getRequestUri($request, $locale);

                return redirect()->to($path);
            }

            session()->put('locale', $locale);
            app()->setLocale($locale);
        }

        return $next($request);
    }

    /**
     * Get Request URI
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $locale
     * @return string
     */
    private function getRequestUri(Request $request, string $locale): string
    {
        $segments = explode('/', $request->getRequestUri());
        $segments = array_values(array_filter($segments));

        if (isset($segments[0]) && $this->isLocale($segments[0])) {
            array_shift($segments);
        }

        $segments = array_prepend($segments, $locale);

        return implode('/', $segments);
    }

    /**
     * Lets know if a value is a locale like the following format: locale_COUNTRY
     *
     * @param string|null $value
     * @return bool
     */
    private function isLocale(?string $value): bool
    {
        return (bool) preg_match('/^[a-z]{2}(_[a-z]{2})?$/i', $value);
    }
}
