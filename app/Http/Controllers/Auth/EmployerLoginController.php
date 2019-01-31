<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Employer;

class EmployerLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:employer', 'guest:employee', 'guest:admin', 'guest:tablet'])->except('logout');
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
            $employer = Employer::find(Auth::guard('employer')->user()->id);
            if($employer->status == false){
                Auth::guard('employer')->logout();
                Session::flush();
                Session::flash('message', 'Access Forbidden!');
                return redirect()->back()->withInput();
            }
            
            Session::flash('message', 'Hello' . $employer->name);
            
            return redirect()->intended(route('employer.home'));
        }
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::guard('employer')->logout();
        Session::flush();
        return redirect('/');
    }

}
