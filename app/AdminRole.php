<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $fillable = ['user_id','role_id'];

    protected $table = 'admin_roles';

    public function user() {
      return $this->belongsTo('App\User','user_id');
    }

    public function role() {
      return $this->belongsTo('App\Role','role_id');
    }

}
