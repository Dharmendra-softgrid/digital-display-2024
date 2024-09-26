<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductCategory extends Model
{
   
    protected $table = 'product_category';

    public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
    }

    protected $fillable = ['title','meta_title','meta_keywords','meta_description','slug','description'];

    
   
    /**
     * Products
     */
    public function products() {
        return $this->belongsToMany('App\Product','product_category_map')
                                                        ->as('products')
                                                        ->withTimestamps();
    }

   
}
