<?php

namespace App\Http\Controllers;

use App\Employer;

class AdminEmployersByEmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(string $email)
    {
        $employers = Employer::where('email', 'like', '%' . $email . '%')->paginate(10);

        if (!$employers->total()) {
            session()->flash('mesage', 'Nothing Found');
        }
        
        return view('admin.employers.index')->withEmployers($employers);
    }

}
