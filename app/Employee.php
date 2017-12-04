<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{

    use Notifiable;

    protected $table = 'employees';
    protected $guard = 'employeе';

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
        return $this->belongsTo('App\Employer');
    }

    public function tablets()
    {
        return $this->belongsToMany('App\Tablet');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function totals()
    {
        return $this->belongsToMany('App\Total');
    }

    public function tables()
    {
        return $this->belongsToMany('App\Table');
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
