<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employer;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employer.dashboard');
    }

    public function getEmployees()
    {
        $id        = Auth::guard('employer')->user()->id;
        $employees = Employer::find($id)->getAllEmployees(10);
        
        return view('employer.employees.employees')->withEmployees($employees);
    }
    
}
