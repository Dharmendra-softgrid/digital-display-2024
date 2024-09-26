<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Content extends Model
{
    
    protected $table = 'content';

    protected $fillable = ['title','content','section_type','page', 'image', 'slider'];
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
