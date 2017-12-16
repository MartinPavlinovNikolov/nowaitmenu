<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';
    public $timestamps = false;

    public function menu()
    {
        return $this->belongTo('App\Menu');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

}
