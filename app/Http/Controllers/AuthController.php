<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input;


class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            throw new \Exception('Wrong email or password.');
        }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if (!empty(auth::user()->two_factor_confirmed) && auth::user()->two_factor_confirmed == 1) {
            $user = auth::user();
            $user->two_factor_confirmed = 0;
            $user->save();
        }
        \Auth::logout();
        return redirect('login');
    }
}
