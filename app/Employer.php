<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{

    use Notifiable;

    protected $table = 'employers';
    protected $guard = 'employer';
    protected $dates = ['last_login'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function menu()
    {
        return $this->hasOne('App\Menu');
    }

    public function admins()
    {
        return $this->belongsToMany('App\Admin');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function tablets()
    {
        return $this->hasMany('App\Tablet');
    }
    
    public function tables()
    {
        return $this->hasMany('App\Table');
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
