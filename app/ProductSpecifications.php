<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProductSpecifications extends Model
{
    
    protected $table = 'product_specification';
    protected $fillable = ['product_id','variant_id','title','value','type'];

   
    
    
    
}
