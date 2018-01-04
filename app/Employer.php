<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employer extends Authenticatable
{

    use Notifiable;
    use Trates\Status;

    protected $table = 'employers';
    protected $guard = 'employer';
    protected $dates = ['last_login'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function menu()
    {
        return $this->hasOne('App\Menu');
    }

    public function admins()
    {
        return $this->belongsToMany('App\Admin');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function tablets()
    {
        return $this->hasMany('App\Tablet');
    }

    public function tables()
    {
        return $this->hasMany('App\Table');
    }

    /**
     * Delete the employer and all employees to that employer from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
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

        //custom delete related models
        $this->status()->delete();
        foreach ($this->employees()->get() as $employee)
        {
            $employee->delete();
        }

        if ($this->fireModelEvent('deleting') === false) {
            return false;
        }

        // Here, we'll touch the owning models, verifying these timestamps get updated
        // for the models. This will allow any caching to get broken on the parents
        // by the timestamp. Then we will go ahead and delete the model instance.
        $this->touchOwners();

        $this->performDeleteOnModel();

        // Once the model has been deleted, we will fire off the deleted event so that
        // the developers may hook into post-delete operations. We will then return
        // a boolean true as the delete is presumably successful on the database.
        $this->fireModelEvent('deleted', false);

        return true;
    }

    /**
     * 
     * @return DB-field for authentication
     * by default is: email
     */
    public function username()
    {
        return 'email';
    }

    /**
     * get all employers for current administrator.
     *
     * @param type ( integer )$numberOfPages
     *      default: 10; 
     * @return all employers paginate by *
     */
    public function getAllEmployees(int $numberOfPages = null)
    {
        if ($numberOfPages == null) {
            return $this->employees()->get();
        }
        return $this->employees()->paginate($numberOfPages);
    }

}
