<?php namespace Vdomah\JWTAuth\Models;

use RainLab\User\Models\User as UserBase;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends UserBase implements JWTSubject
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
