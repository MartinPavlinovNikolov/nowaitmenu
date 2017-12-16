<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $table = 'admins';
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employers()
    {
        return $this->belongsToMany('App\Employer');
    }

    /**
     * 
     * @return DB-field for authentication
     * by default is: email
     */
    public function username()
    {
        return 'name';
    }

    /**
     * get all employers for current administrator.
     * 
     * @return type
     */
    public function getAllEmployers($numberOfPages = 10)
    {
        return $this->employers()->paginate($numberOfPages);
    }

    public function getFilteredEmployersByCompanyName($name, $numberOfPages)
    {
        return $this->employers()->where('name', 'LIKE', '%' . $name . '%')->paginate($numberOfPages);
    }

    public function getFilteredEmployersByEmail($email, $numberOfPages)
    {
        return $this->employers()->where('email', 'LIKE', '%' . $email . '%')->paginate($numberOfPages);
    }

    public function logoutEmployer($id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        $employer->status()->update([
            'active' => false
        ]);

        return $name;
    }

    public function deleteEmployer($id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        $employer->admins()->detach();
        $employer->status()->delete();
        $employer->delete();

        return $name;
    }

    public function loginEmployer($id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        $employer->status()->update([
            'active' => true
        ]);

        return $name;
    }
    
    public function getActiveEmployers($numberOfPages = 10)
    {
        return $this->employers()->whereHas('Status', function($status){
        $status->where('active', true);
        })->paginate($numberOfPages);
    }
    
    public function getDisabledEmployers($numberOfPages = 10)
    {
        return $this->employers()->whereHas('Status', function($status){
        $status->where('active', false);
        })->paginate($numberOfPages);
    }

}
