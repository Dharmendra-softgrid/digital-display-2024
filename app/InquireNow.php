<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InquireNow extends Model
{
    protected $table = 'inquiry';
    protected $fillable = ['id','first_name','last_name','email','phone','city','company','interested_category','interested_subcategory','product'];
}
