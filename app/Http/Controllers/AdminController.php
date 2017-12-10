<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Illuminate\Support\Facades\Session;

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
        $id        = Auth::guard('admin')->user()->id;
        $employers = Admin::find($id)->getAllEmployers(10);
        return view('admin.dashboard')->withEmployers($employers);
    }

    public function getSettings()
    {
        return view('admin.settings');
    }

    public function admin_credential_rules(array $data)
    {
        $messages = [
            'current_password.required' => 'Please enter current password',
            'password.required'         => 'Please enter password',
        ];

        $validator = Validator::make($data, [
                    'current_password'      => 'required',
                    'password'              => 'required|min:6',
                    'password_confirmation' => 'required|same:password',
                        ], $messages);

        return $validator;
    }

    public function postSettings(Request $request)
    {

        $request_data = $request->All();
        $validator    = $this->admin_credential_rules($request_data);
        if ($validator->fails()) {
            return redirect()->back()->withInput();
        }
        else {
            $current_password = Auth::guard('admin')->User()->password;
            if (Hash::check($request_data['current_password'], $current_password)) {
                $admin           = Admin::find(Auth::guard('admin')->User()->id);
                $admin->password = Hash::make($request_data['password']);
                $admin->update();
                Auth::guard('admin')->login($admin);
                return redirect()->route('admin.dashboard');
            }
            else {
                $error = array('current_password' => 'Please enter correct current password');
                return redirect()->back()->withErrors($error)->withInput();
            }
        }
    }

    public function getSearchEmployers(Request $request)
    {
        if ($request->input('sort') == 'name') {
            $employers = Admin::find(Auth::guard('admin')->user()->id)->getFilteredEmployersByCompanyName($request->input('value'), 10);
        }
        elseif ($request->input('sort') == 'email') {
            $employers = Admin::find(Auth::guard('admin')->user()->id)->getFilteredEmployersByEmail($request->input('value'), 10);
        }

        return view('admin.dashboard')->withEmployers($employers);
    }

}
