<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Employee extends Authenticable
{
    protected $guard = 'employee';
    protected $guarded = [];
    
    public function employer() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Employer');
    }
}
