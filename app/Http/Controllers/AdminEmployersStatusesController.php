<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminEmployersStatusesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id)
    {
        try {
            $employer = Employer::findOrFail($id);
            $employer->update(['status' => $employer->boolean_status ? false : true]);
        }
        catch (ModelNotFoundException $e) {
            
            session()->flash('message', 'Employer do not exist!');
            
            return redirect()->back()->setStatusCode(404);
        }

        return redirect()->route('admin.home');
    }

}
