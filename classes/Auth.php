<?php namespace Vdomah\JWTAuth\Classes;

use Tymon\JWTAuth\Contracts\Providers\Auth as AuthProviderContract;

class Auth implements AuthProviderContract
{
    /**
     * The authentication guard.
     *
     */
    protected $auth;

    /**
     * Constructor.
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->auth = AuthManager::instance();
    }

    /**
     * Check a user's credentials.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function byCredentials(array $credentials)
    {
        return $this->auth->once($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param mixed $id
     *
     * @return bool
     */
    public function byId($id)
    {
        return $this->auth->onceUsingId($id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->auth->user();
    }
}
