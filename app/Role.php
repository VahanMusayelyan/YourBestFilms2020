<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        /**
         * Пользователи, которые принадлежат данной роли.
         */
        return $this->belongsToMany('App\User', 'user_roles', 'user_id', 'role_id');
    }
}
