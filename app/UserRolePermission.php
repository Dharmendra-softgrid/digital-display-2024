<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRolePermission extends Model
{
    protected $fillable = ['user_role_id','permission'];

    protected $table = 'user_roles_permission';

}
