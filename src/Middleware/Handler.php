<?php

namespace Arnissolle\Localization\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class Handler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $redirect = null;
        $localQueryParameter = config('localization.locale_query_parameter', 'en');
        $enableSession = config('localization.detect_via_session', true);
        $enableHttpHeader = config('localization.detect_via_http_header', true);

        if (app('localization')->isValidLocale($locale = $request->get($localQueryParameter))) {

            // 1. Priority: Locale via query parameter

            $this->setLocale($locale, $enableSession);
            $redirect = $this->localizationRedirect($locale, 301);

        } elseif ($enableSession
            && session()->has('locale')
            && app('localization')->isValidLocale(session()->get('locale'))) {

            // 2. Priority: Locale via session

            $locale = session()->get('locale');
            $this->setLocale($locale, $enableSession);
            $redirect = $this->localizationRedirect($locale);

        } elseif($enableHttpHeader
            && $request->header('Accept-Language')
            && $locale = $request->getPreferredLanguage(array_keys(app('localization')->getLocales()))) {

            // 3. Priority: Locale via HTTP header

            $this->setLocale($locale, $enableSession);
            $redirect = $this->localizationRedirect($locale);

        } elseif (app('localization')->isLocalizedRoute()) {

            // 4. Priority: Locale via URL prefix

            $locale = $request->route()->getAction()['localization'];
            $this->setLocale($locale, $enableSession);
        }

        return $redirect ?: $next($request);
    }

    /**
     * Set the locale and remember it via session.
     *
     * @param string|null $locale
     * @param bool $enableSession
     */
    private function setLocale(?string $locale, bool $enableSession = true)
    {
        if ( ! app('localization')->isValidLocale($locale)) {
            return;
        }

        app()->setLocale($locale);

        if ($enableSession) {
            session()->put('locale', $locale);
        }
    }

    /**
     * Redirect the user to the localized route, if there is any available.
     *
     * @param string|null $locale
     * @param int $code
     * @return RedirectResponse|null
     */
    private function localizationRedirect(?string $locale, int $code = 302)
    {
        $enableRedirect = config('localization.redirect_to_localized_route', true);
        $localQueryParameter = config('localization.locale_query_parameter', 'en');

        if (!app('localization')->isLocalizedRoute()
            || !$enableRedirect) {
            return null;
        }

        $url = app('localization')->getLocaleUrl($locale);

        if (strtok($url, '?') == request()->url()
            && !request()->query($localQueryParameter)) {
            return null;
        }

        session()->reflash();

        return new RedirectResponse(empty($url) ? '/' : $url, $code, [
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 0,
        ]);
    }
}