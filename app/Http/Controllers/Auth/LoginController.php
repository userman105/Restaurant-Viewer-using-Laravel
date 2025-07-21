<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $request->session()->forget('url.intended');

            $user = Auth::user();

            if ($user->account_type === 'customer') {
                $exists = DB::table('customers')->where('CustomerID', $user->id)->exists();

                if (!$exists) {
                    return redirect('/customer/setup');
                }

                return redirect('/customer/main');
            }

            if ($user->account_type === 'employee') {
                return redirect('/employee/dashboard');
            }

            return redirect('/');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


}
