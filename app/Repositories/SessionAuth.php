<?php


namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SessionAuth
{
    CONST CACHE_KEY = 'SESSION_AUTH';

    public function user()
    {
        return Auth::user();
    }

    public function profile()
    {

    }

    public function get()
    {

    }

    public function getCacheKey($key)
    {
        $key = Str::upper($key);
        return self::CACHE_KEY.".$key";
    }
}
