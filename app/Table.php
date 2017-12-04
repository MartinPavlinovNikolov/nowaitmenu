<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    
    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }
}
