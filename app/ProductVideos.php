<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProductVideos extends Model
{
    
    protected $table = 'product_videos';
    protected $fillable = ['product_id','type','video'];
    
    
}
