<?php

namespace App\Extensions;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Mongodb\User;
use Laravel\Sanctum\Guard;

class MongodbUserProvider implements UserProvider
{
    public function __construct(
        protected User $user
    ) {}

    public function retrieveById($identifier)
    {
        return $this->user->fetchUser(['id' => $identifier]);
    }

    public function retrieveByToken($identifier, $token)
    {
        return $this->user->fetchUser(['id' => $identifier, 'token' => $token]);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {
        return $this->user->fetchUser($credentials);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return ($credentials['id'] == $user->getAuthIdentifier() && md5($credentials['password']) == $user->getAuthPassword());
    }
}
