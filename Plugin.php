<?php namespace Vdomah\JWTAuth;

use App;
use Config;
use Illuminate\Foundation\AliasLoader;
use Vdomah\JWTAuth\Models\User;
use System\Classes\PluginBase;
use Vdomah\JWTAuth\Classes\Auth;
use Vdomah\JWTAuth\Models\Settings;

class Plugin extends PluginBase
{
    /**
     * @var array   Require the RainLab.User plugin
     */
    public $require = ['RainLab.User'];

    public function registerComponents()
    {
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

        App::register('\Vdomah\JWTAuth\Classes\OctoberServiceProvider');
        App::bind('JWTSubject', '\Vdomah\JWTAuth\Models\User');

        $facade = AliasLoader::getInstance();
        $facade->alias('JWTAuth', '\Tymon\JWTAuth\Facades\JWTAuth');
        $facade->alias('JWTFactory', '\Tymon\JWTAuth\Facades\JWTFactory');

        App::singleton('auth', function ($app) {
            return new \Illuminate\Auth\AuthManager($app);
        });

        $this->app['router']->middleware('jwt.auth', '\Tymon\JWTAuth\Http\Middleware\Authenticate');
        $this->app['router']->middleware('jwt.refresh', '\Tymon\JWTAuth\Http\Middleware\RefreshToken');
    }
}
