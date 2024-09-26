<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class IndustryImages extends Model
{
    
    protected $table = 'industry_images';
    protected $fillable = ['industry_id','image'];
    
    
}
