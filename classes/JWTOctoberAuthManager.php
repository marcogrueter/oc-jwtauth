<?php namespace Vdomah\JWTAuth\Classes;

use RainLab\User\Classes\AuthManager as RainlabAuthManager;
use Vdomah\JWTAuth\Contracts\JWTOctoberAuth;
use Vdomah\JWTAuth\Traits\AuthenticatesUser;

class JWTOctoberAuthManager extends RainlabAuthManager implements JWTOctoberAuth
{
    use AuthenticatesUser;

    protected $userModel = 'Vdomah\JWTAuth\Models\User';
}
