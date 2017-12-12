<?php

namespace App\Http\Controllers\Auth;

use App\Employer;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class EmployerRegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware(['guest:employer', 'guest:employee', 'guest:admin', 'guest:tablet']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                    'name'                  => 'required|string|min:2|max:255',
                    'email'                 => 'required|string|email|max:255|unique:employers',
                    'password'              => 'required|string|min:6|confirmed',
                    'password_confirmation' => 'same:password'
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.employer-register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $employer             = new Employer();
        $employer->name       = $data['name'];
        $employer->email      = $data['email'];
        $employer->password   = bcrypt($data['password']);
        $employer->last_login = date('Y-m-d H:i:s', time());
        $employer->status     = true;
        $employer->save();

        $admins = Admin::all();
        foreach ($admins as $admin)
        {
            $employer->admins()->attach($admin);
        }
        return $employer;
    }

    protected function guard()
    {
        return Auth::guard('employer');
    }

}
