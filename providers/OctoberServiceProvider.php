<?php namespace Vdomah\JWTAuth\Providers;

use Config;
use Tymon\JWTAuth\JWTGuard;
use Vdomah\JWTAuth\Classes\JWTBackendOctoberAuthManager;
use Vdomah\JWTAuth\Classes\JWTOctoberAuthManager;
use Vdomah\JWTAuth\Models\Settings;

class OctoberServiceProvider extends \Tymon\JWTAuth\Providers\LaravelServiceProvider
{
    /**
     * Helper to get the config values.
     *
     * @param string $key
     * @return string
     */
    protected function config($key, $default = null)
    {
        $val = Settings::get($key);

        if (!$val) {
            $val = Config::get('vdomah.jwtauth::' . $key);
        }

        return $val ?: config("jwt.$key", $default);
    }

    /**
     * Extend Laravel's Auth.
     *
     * @return void
     */
    protected function extendAuthGuard()
    {
        JWTOctoberAuthManager::extend(function ($class) {
            $class->addDynamicMethod('jwt', function ($app, $name, array $config) {
                $guard = new JWTGuard(
                    $app['tymon.jwt'],
                    $app['auth']->createUserProvider($config['provider']),
                    $app['request']
                );

                $app->refresh('request', $guard, 'setRequest');

                return $guard;
            });
        });

        JWTBackendOctoberAuthManager::extend(function ($class) {
            $class->addDynamicMethod('jwt', function ($app, $name, array $config) {
                $guard = new JWTGuard(
                    $app['tymon.jwt'],
                    $app['auth']->createUserProvider($config['provider']),
                    $app['request']
                );

                $app->refresh('request', $guard, 'setRequest');

                return $guard;
            });
        });
    }

}
