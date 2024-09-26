<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Slider extends Model
{
    
    protected $table = 'slider';

    protected $fillable = ['slide_title','slide_content','content','image','type'];
    /**
     * GET product images
     */
    // public function images() {
    //   return $this->hasMany(IndustryImages::class,'industry_id','id');
    // }
    // public function videos() {
    //   return $this->hasMany(IndustryVideos::class,'industry_id','id');
    // }
    // public function products() {
    //     return $this->belongsToMany('App\Product','product_industry_map','industry_id')
    //                                                     ->as('products') ;
    // }
    // public function newQuery($excludeDeleted = true) {
    //     return parent::newQuery($excludeDeleted)
    //         ->where("active", '=', 1);
    // }
    

    
    
    
}
