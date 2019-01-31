<?php

namespace App\Http\Controllers;

use App\Employer;

class AdminEmployersController extends Controller
{

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
        $employers = Employer::paginate(10);
        
        if(!$employers->total()){
            session()->flash('mesage', 'Nothing Found');
        }

        return view('admin.employers.index')->withEmployers($employers);
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
