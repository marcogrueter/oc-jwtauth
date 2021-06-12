<?php

namespace Vdomah\JWTAuth\Traits;

trait AuthenticatesUser
{
    use \October\Rain\Extension\ExtensionTrait;

    /**
     * When using the Extensiontrait, your behaviour also has to implement this method
     * @see \October\Rain\Extension\ExtensionBase
     */
    public static function extend(callable $callback)
    {
        self::extensionExtendCallback($callback);
    }

    /**
     * Authenticate by credentials
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function byCredentials(array $credentials)
    {
        return $this->once($credentials);
    }

    /**
     * Authenticate by id
     *
     * @param mixed $id
     *
     * @return bool
     */
    public function byId($id)
    {
        return $this->onceUsingId($id);
    }

    /**
     * Returns the authenticated user
     *
     * @param mixed $id
     *
     * @return bool
     */

    public function user()
    {
        return $this->getUser();
    }
}
