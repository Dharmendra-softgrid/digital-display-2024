<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProductBlog extends Model
{
    
    protected $table = 'product_blog';
    protected $fillable = ['product_id','variant_id','title','description','image'];

   
    
    
    
}
