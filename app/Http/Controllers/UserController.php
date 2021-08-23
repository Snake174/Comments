<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('users')
            ->where('name', '=', $request->input('name'))
            ->where('password', '=', $request->input('password'))
            ->first();

        if ($user != null)
        {
            Auth::loginUsingId($user->id, $remember = true);
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
