<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployerLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:employer', 'guest:employee', 'guest:admin', 'guest:tablet'])->except('employerLogout');
    }

    public function showLoginForm()
    {
        return view('auth.employer-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|string|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('employer')->attempt([
                    'email'    => $request->email,
                    'password' => $request->password
                ])) {
            return redirect()->intended(route('employer.dashboard'));
        }
        return redirect()->back()->withInput();
    }

    public function employerLogout()
    {
        Auth::guard('employer')->logout();
        Session::flush();
        return redirect('/');
    }

}
