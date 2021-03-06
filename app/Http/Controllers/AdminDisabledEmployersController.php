<?php

namespace App\Http\Controllers;

use App\Employer;

class AdminDisabledEmployersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $employers = Employer::disabled()->paginate(10);

        if (!$employers->total()) {
            session()->flash('mesage', 'Nothing Found');
        }

        return view('admin.employers.index')->withEmployers($employers);
    }

}
