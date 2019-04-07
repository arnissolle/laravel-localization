<?php

namespace Arnissolle\Localization\Support;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('localization.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'localization'
        );

        $this->app->singleton('url', function($app) {

            // see: Illuminate\Routing\RoutingServiceProvider
            $routes = $app['router']->getRoutes();

            // The URL generator needs the route collection that exists on the router.
            // Keep in mind this is an object, so we're passing by references here
            // and all the registered routes will be available to the generator.
            $app->instance('routes', $routes);
            $url = new UrlGenerator($routes, $app->make('request'), $app['config']['app.asset_url']);

            // Next we will set a few service resolvers on the URL generator so it can
            // get the information it needs to function. This just provides some of
            // the convenience features to this URL generator like "signed" URLs.
            $url->setSessionResolver(function() {
                return $this->app['session'];
            });

            $url->setKeyResolver(function() {
                return $this->app->make('config')->get('app.key');
            });

            // If the route collection is "rebound", for example, when the routes stay
            // cached for the application, we will need to rebind the routes on the
            // URL generator instance so it has the latest version of the routes.
            $app->rebinding('routes', function($app, $routes) {
                $app['url']->setRoutes($routes);
            });

            return $url;
        });

        $this->app->singleton('localization', function($app) {
            return new Localization($app->make('request'));
        });

        $this->registerRouteMacro();
    }

    /**
     * Registers the Route localization() / getLocalization() Macros
     *
     * @return void
     */
    private function registerRouteMacro()
    {
        Route::macro('getLocalization', function() {
            return $this->action['localization'] ?? null;
        });

        Route::macro('localization', function ($localization) {

            if (is_null($localization)) {
                return $this->getLocalization();
            }

            $this->action['localization'] = $localization;

            return $this;
        });
    }
}