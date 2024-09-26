<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variant';
    protected $fillable = ['id','product_id','variant'];
    
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
