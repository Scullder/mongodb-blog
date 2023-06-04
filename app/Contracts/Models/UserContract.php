<?php

namespace App\Contracts\Models;

interface UserContract
{
    public function getToken(): string;
    public function createToken(): string|bool;

}