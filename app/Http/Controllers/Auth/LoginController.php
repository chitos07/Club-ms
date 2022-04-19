<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public int $seconds =  120;
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request) {

        $this->CheckhasTooManyLoginAttempts();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!Auth()->attempt($request->only('email','password'))){
            RateLimiter::hit($this->throttleKey(),$this->seconds);
            return response()->json([
                'message' => 'bad cards'
            ], 401);
        }

       // $user = Auth::user();

        $scopes = auth()->user()->Peremison();

        $token = Auth()->user()->createToken('Personal Access Token',$scopes)->accessToken;

        RateLimiter::clear($this->throttleKey());
        return response()->json([

            'token' => $token,
            'user' => Auth()->user(),

        ],201);

    }

    // implement Login Limit methods
    public function throttleKey()
    {
        return Str::lower(request('email')) . ' | ' . request()->ip();
    }

    public function CheckhasTooManyLoginAttempts(){

        if(RateLimiter::tooManyAttempts($this->throttleKey(),5)){
            throw ValidationException::withMessages([
                request('email') => [Lang::get('auth.throttle', [
                    'seconds' => $this->seconds,
                    'minutes' => ceil($this->seconds / 60),
                    'hours' => ceil($this->seconds / 60 / 60),
                ])],
            ])->status(Response::HTTP_TOO_MANY_REQUESTS);
        };
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout'
        ]);
    }
}
