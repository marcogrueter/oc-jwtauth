<?php namespace Vdomah\JWTAuth;

use App;
use Config;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use Vdomah\JWTAuth\Models\Settings;

class Plugin extends PluginBase
{
    public $elevated = true;

    public function registerComponents()
    {
        return [];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'vdomah.jwtauth::lang.settings.page_name',
                'description' => 'vdomah.jwtauth::lang.settings.page_desc',
                'category'    => 'vdomah.jwtauth::lang.plugin.name',
                'icon'        => 'oc-icon-key',
                'class'       => Settings::class,
                'order'       => 500,
                'keywords'    => 'jwt jwtauth',
                'permissions' => ['vdomah.jwtauth.settings'],
            ],
        ];
    }

    public function register()
    {
        $configItems = Config::get('vdomah.jwtauth::auth');

        foreach ($configItems as $key => $values) {
            if (empty(Config::get('auth.' . $key))) {
                Config::set('auth.' . $key, $values);
            }
        }

        App::register('\Vdomah\JWTAuth\Providers\OctoberServiceProvider');

        if ($this->app->runningInBackend()) {
            App::singleton('Vdomah\JWTAuth\Contracts\OctoberAuthContract', function () {
                return \Vdomah\JWTAuth\Classes\JWTBackendOctoberAuthManager::instance();
            });
        } elseif (PluginManager::instance()->exists('Rainlab.User')) {
            App::singleton('Vdomah\JWTAuth\Contracts\OctoberAuthContract', function () {
                return \Vdomah\JWTAuth\Classes\JWTOctoberAuthManager::instance();
            });
        }

        App::error(function (\Tymon\JWTAuth\Exceptions\JWTException $exception) {
            return response()->json(['status' => 'unauthorized'], 401);
        });
    }
}
