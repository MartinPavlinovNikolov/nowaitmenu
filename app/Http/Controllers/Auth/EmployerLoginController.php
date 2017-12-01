<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployerLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:employer')->except('employerLogout');
    }

    public function showLoginForm()
    {
        return view('auth.employer-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|string|min:3|max:255',
            'email'    => 'required|string|email|min:1',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('employer')->attempt([
                    'name'    => $request->name,
                    'email'    => $request->email,
                    'password' => $request->password])) {
            return redirect()->intended(route('employer.dashboard'));
        }
        return redirect()->back()->withInput();
    }

    public function employerLogout()
    {
        Auth::guard('employer')->logout();
        return redirect('/');
    }

}
