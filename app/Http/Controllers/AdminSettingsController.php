<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSettingsController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'current_password'      => 'required|min:6',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $admin           = Auth::guard('admin')->user();
        $admin->password = Hash::make($request->password);
        $admin->setRememberToken(Str::random(60));
        $admin->save();
        Auth::guard('admin')->login($admin);

        return view('admin.settings');
    }

}
