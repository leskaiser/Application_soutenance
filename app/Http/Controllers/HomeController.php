<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function otp()
    {
        return view('auth.otp');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with([
            'message' => 'Logout Successfully',
            'success' => true
        ]);
    }

    public function lock()
    {
        return view('auth.lock-screen');
    }

    public function singIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        // dd($request->filled('remember'));

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }else{
            $responseText = __('Invalid Email or Password');
            return redirect('/')->withInput($request->only('email'))->withErrors([
                'email' => $responseText
            ]);
        }

    }

    public function forgotPassword(Request $request)
    {
        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' =>  __($status), 'success' => true])
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
    
    public function reset($token = null, Request $request)
    {
        // dd($token, $request->email);
        $email = $request->email;
        return view("auth.reset", compact('token', 'email'));
    }

    public function resetProcess(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    // 'remember_token' => Str::random(60)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with(['message' =>  __($status), 'success' => true])
            : back()->withInput($request->only('email'))->with(['message' =>  __($status), 'error' => true]);
    }
}
