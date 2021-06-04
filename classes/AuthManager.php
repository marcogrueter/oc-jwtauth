<?php namespace Vdomah\JWTAuth\Classes;

use RainLab\User\Classes\AuthManager as RainlabAuthManager;

class AuthManager extends RainlabAuthManager
{
    protected $userModel = 'Vdomah\JWTAuth\Models\User';

    /**
     * Check a user's credentials.
     *
     * @param  array  $credentials
     *
     * @return bool
     */
    public function byCredentials(array $credentials)
    {
        return $this->once($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param  mixed  $id
     *
     * @return bool
     */
    public function byId($id)
    {
        return $this->onceUsingId($id);
    }

    public function user()
    {
        return $this->getUser();
    }
}
