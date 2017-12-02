<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Employer;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();
        
        $employees = Employee::all();
        
        return view('admin.dashboard')->with(['employers' => $employers, 'employees' => $employees]);
    }

    public function getSettings()
    {
        return view('admin.settings');
    }

    public function postSettings(Request $request)
    {
        if ($request->validate([
                    'password'            => 'required|min:6',
                    'new_password'        => 'required|min:6',
                    'new_password_repeat' => 'required|same:new_password|min:6'
                ])) {
            $admin           = Admin::find(Auth::guard('admin')->user()->admin_id);
            $admin->password = bcrypt($request->new_password);
            $admin->update();

            return redirect()->back();
        }

        return redirect()->back()->withErrors()->withInput();
    }

}
