<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employer;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminEmployeesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin, auth:employer');
    }

    public function index()
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $employees   = Employer::find($employer_id)->employees()->all();

        return view('employer.employees.index')->withEmployees($employees);
    }

    public function show($employee_id)
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $employee    = Employer::find($employer_id)->employees()->find($employee_id);
        return view('employer.employees.show')->withEmployee($employee);
    }

    public function create()
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $employer    = Employer::find($employer_id);
        return view('employer.employees.create')->withEmployer($employer);
    }

    public function store(Request $request)
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $this->validate($request, [
            'name'     => 'required|min:3|string',
            'password' => 'required|min:4|max:4',
            'status'   => 'required'
        ]);

        $employee              = new Employee();
        $employee->name        = $request->name;
        $employee->password    = Hash::make($request->password);
        $employee->status      = (bool) $request->status;
        $employee->employer_id = $employer_id;
        $employee->save();

        return redirect()->route('employees.index');
    }

    public function edit(int $employee_id)
    {
        $employer_id = Auth::guard('employer')->user()->id;
        $employee    = Employer::find($employer_id)->employees()->find($employee_id);

        return view('employer.employees.edit')->withEmployee($employee);
    }

    public function update(Request $request, int $employee_id)
    {
        if (Auth::guard('admin')->check()) {
            $employee         = Employee::find($employee_id);
            $employee->status = $employee->status ? false : true;
            $employee->save();
            
            return redirect()->route('admin.home');
        }
        else if (Auth::guard('employer')->check()) {
            $employer_id = Auth::guard('employer')->user()->id;
            $this->validate($request, [
                'name'     => 'required|min:3|string',
                'password' => 'required|min:4|max:4',
                'status'   => 'required'
            ]);

            $employee              = Employee::find($employee_id);
            $employee->name        = $request->name;
            $employee->password    = Hash::make($request->password);
            $employee->status      = !(bool) $employee->status;
            $employee->employer_id = $employer_id;
            $employee->save();

            return redirect()->route('employees.index');
        }
    }

}
