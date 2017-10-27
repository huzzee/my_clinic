<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','entity_id','role_id','status','profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function entities()
    {
        return $this->belongsTo('App\models\Entity','entity_id');
    }

    public function roles()
    {
        return $this->belongsTo('App\models\Role','role_id');
    }

    public function admins()
    {
        return $this->hasMany('App\models\Admin','id');
    }


    public static function createUsers($data,$filename,$entity_id,$status)
    {
        $users = new User([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['full_name'],
            'role_id' => $data['role_id'],
            'entity_id' => $entity_id,
            'status' => $status,
            'profile_image' => $filename

        ]);

        $users->save();

        return $users->id;
    }
}
