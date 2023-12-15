<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check())
        {
            return redirect()->route('index');
        }

        return view('admin.login');
    }

    public function login_post(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        if ($request->remember == "on") {
            $remember = true;
        } else {
            $remember = false;
        }

        if ($request->email != 'test@gmail.com')
        {
            return response()->json(['status' => 0,'error'=>'Bu sayfaya yetkiniz yoktur.']);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                return response()->json(['status' => 1, 'success' => 'Başarılı bir şekilde giriş yaptınız!']);
        } else {
            return response()->json(['status' => 0,'error'=>'Email adı veya şifre hatalı!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('Auth');
        return redirect()->route('login');
    }
}
