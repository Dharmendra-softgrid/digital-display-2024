<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class SuccessStories extends Model
{
    
    protected $table = 'success_stories';

    protected $fillable = ['title','banner_image','content','short_description','banner_section'];
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
