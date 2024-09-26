<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;


class ProductIndustryMap extends Model
{
   
    protected $table = 'product_industry_map';

    public $timestamps = false;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
    }

    protected $fillable = ['product_id','industry_id'];
    
    public function product() {
      return $this->belongsTo('App\Product');
    }
}
