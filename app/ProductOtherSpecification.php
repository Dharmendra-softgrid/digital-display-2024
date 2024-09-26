<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOtherSpecification extends Model
{
    protected $table = 'product_other_specification';
    protected $fillable = ['product_id','title','description'];
}
