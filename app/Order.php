<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = false;

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }

}
