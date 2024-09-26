<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\ProductImages;
use App\ProductCategory;
use App\ProductVideos;
use App\ProductSpecifications;
use App\ProductBlog;
use App\ProductVariantList;
use App\ProductVariant;

class Product extends Model
{
    

    protected $fillable = ['title','meta_title','meta_keywords','meta_description','slug','description','featured_image','created_by','updated_by','meta_title','meta_keywords','meta_description', 'model','series'];

    protected $searchable = [
        'title',
        'description'
    ];

    // public static function boot() {
    //     parent::boot();
    //     self::creating(function ($model) {
    //     $model->created_by = Auth::id();
    //     $model->updated_by = Auth::id();
    //   });
    // }
    /**
     * GET product images
     */
    public function product_images() {
      return $this->hasMany(ProductImages::class);
    }

    public function blogs() {
      return $this->hasMany(ProductBlog::class);
    }
    
    public function specifications() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'specification');;
    }
    public function resources() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'resource');
    }
    public function specsheets() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'resource')->where('title','=', 'specesheet');
    }
    public function casestudy() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'resource')->where('title','=', 'casestudy');
    }
    public function brochures() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'resource')->where('title','=', 'brochures');
    }
    public function accessories() {
      return $this->hasMany(ProductSpecifications::class)->where('type','=', 'accessory');
    }

    public function videos() {
      return $this->hasMany(ProductVideos::class,'product_id','id');
    }   

    /**
     * GET Product Categories
     */
    public function product_categories() {
        return $this->belongsToMany('App\ProductCategory','product_category_map')->as('categories');
    }
    public function industries() {
        return $this->belongsToMany('App\Industries','product_industry_map','product_id','industry_id')->as('industries');
    }
    public function variants() {
      return $this->hasMany('App\ProductVariant');
    }
  
    
}
