<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class CustomAuthController extends Controller
{
    public function adult()
    {
        return view('customAuth.index');
    }
    public function site()
    {
        return view('auth.site');
    }
    public function admin()
    {
        return view('auth.admin');
    }

    public function adminlogin()
    {
        return view('auth.adminlogin');
    }

    public function checkadminlogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));
    }
}
