<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Employer;
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
        $id = Auth::guard('admin')->user()->id;
        if ($request->input('sort') == 'name') {
            $employers = Admin::find($id)->getFilteredEmployersByCompanyName($request->input('value'), 10);
            $employers->appends(['sort' => 'email', 'value' => $request->input('value')])->render();
        }
        elseif ($request->input('sort') == 'email') {
            $employers = Admin::find($id)->getFilteredEmployersByEmail($request->input('value'), 10);
            $employers->appends(['sort' => 'email', 'value' => $request->input('value')])->render();
        }
        Session::flash('value', $request->input('value'));
        Session::flash('sort', $request->input('sort'));

        return view('admin.dashboard')->withEmployers($employers);
    }

    public function logoutEmployer($id)
    {
        $employer         = Employer::find($id);
        $employer->status = false;
        $employer->update();

        Session::flash('message', 'Employer was logget out!');

        return redirect()->back();
    }

    public function deleteEmployer($id)
    {
        $employer = Employer::find($id);
        $employer->admins()->detach();
        $employer->delete();

        Session::flash('message', 'Employer was removed from the sistem!');

        return redirect()->back();
    }

    public function loginEmployer($id)
    {
        $employer         = Employer::find($id);
        $employer->status = true;
        $employer->update();

        Session::flash('message', 'Employer was logget in!');

        return redirect()->back();
    }

}
