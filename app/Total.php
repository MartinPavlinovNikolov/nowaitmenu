<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{

    protected $table = 'totals';
    public $timestamps = false;

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }

}
