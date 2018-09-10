<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this
            ->belongsToMany('App\Role');
    }

    public function authorizeRoles($roles)
    {
        if($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401);
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles)) {
            foreach ($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function currentRole() {
        return DB::table('user_has_roles')->where([
            ['user_id', $this->attributes['id']]
        ])->take(1)->pluck('role_id');
    }

    public function theRole() {
        return DB::table('roles')->where([
            ['id', $this->currentRole()]
        ])->value('description');
    }

    public function persona()
    {
        return $this->hasOne('App\Persona', 'id_persona', 'id_persona');
    }

    public function roles_user() {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }
}
