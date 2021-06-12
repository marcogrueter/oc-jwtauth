<?php

namespace Vdomah\JWTAuth\Contracts;

use Tymon\JWTAuth\Contracts\Providers\Auth as AuthProviderContract;

interface JWTOctoberAuth extends AuthProviderContract
{
    public function once(array $credentials);

    public function onceUsingId($id);

    public function getUser();
}
