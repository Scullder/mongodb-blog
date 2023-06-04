<?php

namespace App\Models\Mongodb;

use App\Models\Mongodb\Mongodb;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Mongodb implements Authenticatable
{
    protected string $collectionName = 'users';
    protected string $primaryKey = 'id';
    protected string  $rememberTokenName = 'remember_token';
    protected $user;

    public function fetchUser(array $credentials, $isCollect = true)
    {
        $this->user = $this->collection()->findOne($credentials);
    
        if ($isCollect) {
            $this->user = collect($this->user);
        }

        return $this;
    }

    public function getAuthIdentifierName() 
    {
        return $this->primaryKey;
    }
    
    public function getAuthIdentifier()
    {
        return $this->user->{$this->primaryKey};
    }

    public function getAuthPassword() 
    {
        return $this->user->password;
    }
    
    public function getRememberToken() 
    {
        return $this->user->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value) 
    {
        $this->user->{$this->getRememberTokenName()} = $value; 
    }
    
    public function getRememberTokenName() 
    {
        return $this->rememberTokenName;
    }
}