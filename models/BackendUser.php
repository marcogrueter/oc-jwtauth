<?php namespace Vdomah\JWTAuth\Models;

use Backend\Models\User as BackendUserBase;
use Tymon\JWTAuth\Contracts\JWTSubject;

class BackendUser extends BackendUserBase implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
