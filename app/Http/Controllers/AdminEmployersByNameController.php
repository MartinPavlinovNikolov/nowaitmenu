<?php

namespace App\Http\Controllers;

use App\Employer;

class AdminEmployersByNameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(string $name)
    {
        $employers = Employer::where('name', 'like', '%' . $name . '%')->paginate(10);

        if (!$employers->total()) {
            session()->flash('mesage', 'Nothing Found');
        }
        
        return view('admin.employers.index')->withEmployers($employers);
    }

}
