<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public function roles()
    {
      return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

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
    //funkcija kuru izmantosim admin skatā, lai parādītu kura loma ir kuram lietotājam
    public function hasRole($role)
    {
      //User::class->roles() = norāda uz intermediate tabulu, kurā role id savukārt norāda uz roles tabulā esošajiem laukiem, tad ar query bulder turpinam
      if ($this->roles()->where('name', '=', $role)->first()) {
        return true;
      }
    }
}
