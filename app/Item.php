<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('App\Page');
    }
    
}
