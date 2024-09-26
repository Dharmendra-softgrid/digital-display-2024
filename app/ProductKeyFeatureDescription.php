<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductKeyFeatureDescription extends Model
{
    protected $table = 'product_keyfeature_desc';
    protected $fillable = ['product_id','variant_id','description'];
}
