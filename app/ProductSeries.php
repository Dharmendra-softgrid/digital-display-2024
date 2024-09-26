<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSeries extends Model
{
    protected $table = 'product_series';
    protected $fillable = ['id','name','category_id'];
}
