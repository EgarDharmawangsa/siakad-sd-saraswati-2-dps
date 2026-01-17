<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function redirect()
    {
        return redirect()->route(auth()->guard('web')->check() ? 'beranda' : 'login');
    }

    /**
     * Show the login form.
     */
    public function index()
    {
        return view('auth.login', [
            'judul' => 'Masuk'
        ]);
    }

    /**
     * Handle login request.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($credentials, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('beranda')->with('success', 'Berhasil masuk.');
        }


        return redirect()->back()
            ->with(['error' => 'Username atau password salah.'])
            ->withInput();
    }

    /**
     * Handle logout request.
     */
    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }
}
