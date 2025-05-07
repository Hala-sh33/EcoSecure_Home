<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'accountType' => 'required|in:admin,homeowner,member',
        ]);
        if ($request->accountType === 'member') {
            $request->validate([
                'userName' => 'required|string',
                'homeID' => 'required',
            ]);
            $member = \App\Models\Member::where('userName', $request->userName)
                ->where('homeID', $request->homeID)
                ->first();
            if ($member && $member->account) {
                Auth::login($member->account);
                session(['member_id' => $member->memberID]);
                return redirect()->route('customer.dashboard');
            } else {
                return back()->with(['error' => 'Invalid username or associated account.']);
            }
        }

        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $credentials = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->login, 'password' => $request->password]
            : ['phoneNumber' => $request->login, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->accountType === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->accountType === 'homeowner') {
                return redirect()->route('customer.dashboard');
            } else {
                Auth::logout();
                return back()->with(['error' => 'Unauthorized access.']);
            }
        }
        return back()->with(['error' => 'Invalid credentials.']);
    }


    public function logout()
    {
        Auth::logout();
        Session::forget('member_id');
        return redirect()->route('login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with('success' ,__($status))
            : back()->with('error' , __($status));
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
//                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
