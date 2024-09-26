<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\IndustryVideos;
use App\IndustryImages;
use App\ProductSpecifications;


class Industries extends Model
{
    
    protected $table = 'industries';

    protected $fillable = ['title','meta_title','meta_keywords','meta_description','content','slug','icon'];
    /**
     * GET product images
     */
    public function images() {
      return $this->hasMany(IndustryImages::class,'industry_id','id');
    }
    public function videos() {
      return $this->hasMany(IndustryVideos::class,'industry_id','id');
    }
    public function products() {
        return $this->belongsToMany('App\Product','product_industry_map','industry_id')
                                                        ->as('products') ;
    }
    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where("active", '=', 1);
    }
    public function IndustryBlog() {
      return $this->hasMany(IndustryBlog::class,'industry_id');
    } 
    public function IndustryDetail() {
      return $this->hasMany(IndustryDetail::class);
    }
}
