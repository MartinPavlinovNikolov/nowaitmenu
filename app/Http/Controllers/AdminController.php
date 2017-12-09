<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

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
        $id = Auth::guard('admin')->user()->id;
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
            'current-password.required' => 'Please enter current password',
            'password.required'         => 'Please enter password',
        ];

        $validator = Validator::make($data, [
                    'current-password'      => 'required',
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
            if (Hash::check($request_data['current-password'], $current_password)) {
                $user_id            = Auth::guard('admin')->User()->id;
                $obj_user           = Admin::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);
                $obj_user->save();
                return redirect()->to(route('admin.login'));
            }
            else {
                $error = array('current-password' => 'Please enter correct current password');
                return redirect()->back()->withErrors($error)->withInput();
            }
        }
    }

}
