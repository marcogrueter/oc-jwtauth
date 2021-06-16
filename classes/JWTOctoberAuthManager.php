<?php namespace Vdomah\JWTAuth\Classes;

use RainLab\User\Classes\AuthManager as RainlabAuthManager;
use Vdomah\JWTAuth\Contracts\OctoberAuthContract;
use Vdomah\JWTAuth\Traits\AuthenticatesUser;

class JWTOctoberAuthManager extends RainlabAuthManager implements OctoberAuthContract
{
    use AuthenticatesUser;

    protected $userModel = 'Vdomah\JWTAuth\Models\User';
}
