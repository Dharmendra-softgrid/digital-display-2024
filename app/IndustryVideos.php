<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class IndustryVideos extends Model
{
    
    protected $table = 'industry_videos';
    protected $fillable = ['industry_id','type','video'];
    
    
}
