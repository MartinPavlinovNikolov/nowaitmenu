<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    public function employer()
    {
        return $this->belongsTo('App\Employer');
    }
    
    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}
