<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
            'name'     => 'required|min:3|max:255',
            'email'    => 'required|email|min:1',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('employer')->attempt([
                    'email'    => $request->email,
                    'password' => $request->password])) {
            return redirect()->intended(route('employer.dashboard'));
        }
        return redirect()->back()->flash();
    }

    public function employerLogout()
    {
        Auth::guard('employer')->logout();
        return redirect('/');
    }

}
