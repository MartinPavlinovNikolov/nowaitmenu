<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employer;

class EmployerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:employer')->only('home');
        $this->middleware('auth:admin')->except('home');
    }

    public function home()
    {
        return view('employer.home');
    }

    public function show(string $sort, string $value)
    {
        $employers = Employer::where($sort, 'like', '%' . $value . '%')->paginate(10);

        return view('admin.home')->withEmployers($employers);
    }

    public function getActive()
    {
        $employers = Employer::active()->paginate(10);

        return view('admin.home')->withEmployers($employers);
    }

    public function getDisabled()
    {
        $employers = Employer::disabled()->paginate(10);

        return view('admin.home')->withEmployers($employers);
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
        $this->validate($request, [
            'name' => 'min:3|string'
        ]);

        $employer         = Employer::find($id);
        $employer->status = $employer->status ? false : true;
        $employer->save();

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $employer = Employer::find($id);
        $employer->delete();

        return redirect()->route('admin.home');
    }

}
