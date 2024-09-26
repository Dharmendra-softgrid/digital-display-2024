<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductVariantList extends Model
{
    protected $table = 'variant_list';
    protected $fillable = ['id','name','status'];
    public function product() {
        return $this->belongsTo('App\Product');
    }
}
