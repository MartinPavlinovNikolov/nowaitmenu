<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    public $timestamps = false;
    
    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }
    
    public function employer(){
        return $this->belongsTo('App\Employer');
    }
}
