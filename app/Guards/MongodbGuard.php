<?php

namespace App\Guards;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class MongodbGuard implements Guard
{
    public function __construct(
        private UserProvider $provider,
        private Request $request,
        private Authenticatable|null $user = null,
        private string $tokenInput = 'api_token',
        private string $storageKey = 'api_key'
    ) {}
    
    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return !is_null($this->user);
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return !$this->check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id()
    {
        return $this->user()->getAuthIdentifier();
    }

    private function getTokenForRequest()
    {
        $token = $this->request->query($this->tokenInput);

        if (empty($token)) {
            $token = $this->request->input($this->tokenInput);
        }

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        return $token ?? '';
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        if (empty($credentials[$this->tokenInput])) {
            return false;
        }

        // $credentials = [$this->storageKey => $credentials[$this->tokenInput]];

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser()
    {
        return !is_null($this->user);
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;

        return $this->user;
    }
}