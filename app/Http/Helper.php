<?php
namespace App\Http;

use DB;
use App\User;
use App\Role;
use App\UserRole;
use App\UserRolePermission;

class Helper {
    
    public static function commission($id) {
        $permissionArray = array();
        $user = User::find($id);
        $permission = UserRolePermission::where('user_role_id',$user->user_role_id)->get(['permission']);
        foreach ($permission as $key => $value) {
           array_push($permissionArray ,$value->permission);
        }
        return $permissionArray;
    }
    
}
