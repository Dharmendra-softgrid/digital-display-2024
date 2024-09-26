<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\ProductImages;
use App\ProductCategory;
use App\ProductVideos;
use App\ProductSpecifications;
use App\ProductBlog;


class Newsroom extends Model
{
    
    protected $table = 'news_room';
    protected $fillable = ['title','slug','meta_title','meta_keywords','meta_description','content','image','short_description','link'];
    protected $searchable = [
        
    ];

    
}
