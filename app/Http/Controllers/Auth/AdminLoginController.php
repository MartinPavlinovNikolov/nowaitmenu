<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:employer', 'guest:employee', 'guest:admin', 'guest:tablet'])->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:2|max:255',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt([
                    'name'     => $request->name,
                    'password' => $request->password
                ])) {
            Session::flash('message', 'Hello ' . Auth::guard('admin')->user()->name);

            return redirect()->intended(route('admin.employers.index'));
        }
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect('/');
    }

}
