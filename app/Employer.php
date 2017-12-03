<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{

    use Notifiable;
    
    protected $table = 'employers';
    protected $guard = 'employer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
    
    /**
     * 
     * @return DB-field for authentication
     * by default is: email
     */
    public function username()
    {
        return 'email';
    }

}
