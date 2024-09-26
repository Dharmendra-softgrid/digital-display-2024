<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustryDetail extends Model
{
    protected $table = 'industry_detail';
    protected $fillable = ['id','industries_id','image','title','content','status','sort_order','position','banner_section'];
    
}
