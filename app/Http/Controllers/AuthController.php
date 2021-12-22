<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function social($provider)
    {
        $auth = Socialite::driver($provider)->stateless()->user();
        $email = $auth->getEmail();
        $avatar = $auth->getAvatar();
        return response()->json(compact('email', 'avatar'));
    }
}
