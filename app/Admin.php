<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $table = 'admins';
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 
     * @return Join with employers table
     */
    public function employers()
    {
        return $this->belongsToMany('App\Employer');
    }

    /**
     * 
     * @return DB-field for authentication
     * by default is: email
     */
    public function username()
    {
        return 'name';
    }

    /**
     * get all employers for current administrator.
     *
     * @param type ( integer )$numberOfPages
     *      default: 10; 
     * @return all employers paginate by *
     */
    public function getAllEmployers(int $numberOfPages = 10)
    {
        return $this->employers()->paginate($numberOfPages);
    }

    /**
     * get all employers for current administrator by name.
     * 
     * 
     * @param type string $name
     * @param integer $numberOfPages
     *      default: 10; 
     * @return all employers, filtered by name.Paginate by *
     */
    public function getFilteredEmployersByCompanyName(string $name, int $numberOfPages)
    {
        return $this->employers()->where('name', 'LIKE', '%' . $name . '%')->paginate($numberOfPages);
    }

    /**
     * get all employers for current administrator by email.
     * 
     * @param string $email
     * @param int $numberOfPages
     * @return all employers, filtered by email.Paginate by *
     */
    public function getFilteredEmployersByEmail(string $email, int $numberOfPages)
    {
        return $this->employers()->where('email', 'LIKE', '%' . $email . '%')->paginate($numberOfPages);
    }

    /**
     * update status of the employer by id.Logout.
     * 
     * @param int $id
     * @return string $name
     */
    public function logoutEmployer(int $id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        $employer->status()->update([
            'active' => false
        ]);

        return $name;
    }

    /**
     * Delete employer by id.
     * 
     * @param int $id
     * @return string $name
     */
    public function deleteEmployer(int $id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        foreach($employer->admins()->get() as $admin){
            $admin->employers()->detach($employer);
        }
        $employer->delete();

        return $name;
    }
    
    /**
     * update status of the employer by id.Login.
     * 
     * @param int $id
     * @return string $name
     */
    public function loginEmployer(int $id)
    {
        $employer = $this->employers()->find($id);
        $name     = $employer->name;
        $employer->status()->update([
            'active' => true
        ]);

        return $name;
    }
    
    /**
     * get collection off all active employers
     * 
     * @param int $numberOfPages default=10;
     * @return colction
     */
    public function getActiveEmployers(int $numberOfPages = 10)
    {
        return $this->employers()->whereHas('Status', function($status) {
                    $status->where('active', true);
                })->paginate($numberOfPages);
    }
    
    /**
     * get collection off all disabled employers
     * 
     * @param int $numberOfPages default=10;
     * @return colction
     */
    public function getDisabledEmployers(int $numberOfPages = 10)
    {
        return $this->employers()->whereHas('Status', function($status) {
                    $status->where('active', false);
                })->paginate($numberOfPages);
    }

}
