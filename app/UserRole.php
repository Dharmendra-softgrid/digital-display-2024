<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['name'];

    protected $table = 'user_roles';

    public function permission(){
        return $this->hasMany('App\UserRolePermission','user_role_id','id');
    }
}
