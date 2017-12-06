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
    public function getAllEmployers()
    {
        return $this->employers;
    }

}
