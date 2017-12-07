<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tablet extends Authenticatable
{

    use Notifiable;

    protected $table = 'tablets';
    protected $guard = 'tablet';

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

    public function employer()
    {
        return $this->belongTo('App\Employer');
    }
    
    public function employees()
    {
        return $this->belongToMany('App\Employee');
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

}
