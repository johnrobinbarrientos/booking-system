<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

class TwoFactorAuthController extends Controller
{
    public function confirm(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'code' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $confirmed = $request->user()->confirmTwoFactorAuth($request->code);

        if (!$confirmed) {
            return back()->with('error','Invalid Two Factor Authentication code');
        }else{
            return redirect()->route('profile');      
        }
        // return back();
    }
}