<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductComponent extends Model
{
    protected $table = 'product_component';
    protected $fillable = ['id','product_id','variant_id','component_type','component_name','component_specification','code','sub_code'];
}
