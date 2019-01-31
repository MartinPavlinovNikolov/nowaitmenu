<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Employer extends Authenticable
{

    protected $guard   = 'employer';
    protected $guarded = [];
    protected $dates   = ['last_login'];

    public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Employee');
    }

    public function delete()
    {
        if (is_null($this->getKeyName())) {
            throw new Exception('No primary key defined on model.');
        }

        // If the model doesn't exist, there is nothing to delete so we'll just return
        // immediately and not do anything else. Otherwise, we will continue with a
        // deletion process on the model, firing the proper events, and so forth.
        if (!$this->exists) {
            return;
        }

        if ($this->fireModelEvent('deleting') === false) {
            return false;
        }

        // Here, we'll touch the owning models, verifying these timestamps get updated
        // for the models. This will allow any caching to get broken on the parents
        // by the timestamp. Then we will go ahead and delete the model instance.
        $this->touchOwners();

        $this->employees()->delete();

        $this->performDeleteOnModel();

        // Once the model has been deleted, we will fire off the deleted event so that
        // the developers may hook into post-delete operations. We will then return
        // a boolean true as the delete is presumably successful on the database.
        $this->fireModelEvent('deleted', false);

        return true;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeDisabled($query)
    {
        return $query->where('status', false);
    }
    
    public function getFormatedLastLoginAttribute()
    {
        return $this->last_login->format('Y/d/m');
    }
    
    public function getFormatedCreatedAtAttribute()
    {
        return $this->created_at->format('Y/d/m');
    }
    
    public function getFormatedUpdatedAtAttribute()
    {
        return $this->updated_at->format('Y/d/m');
    }
    
    public function getBooleanStatusAttribute()
    {
        return !!$this->status;
    }

}
