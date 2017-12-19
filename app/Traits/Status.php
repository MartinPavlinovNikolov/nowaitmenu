<?php

namespace App\Trates;

trait Status
{

    public function status()
    {
        return $this->morphOne('App\Status', 'statusable');
    }

}
