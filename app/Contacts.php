<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Industries;
use App\ProductCategory;



class Contacts extends Model
{
    
    protected $table = 'contacts';

    protected $fillable = ['email','fname','lname','phone','comment','city','industry','category','quantity'];

    public function industryName()
    {
        return $this->belongsTo(Industries::class,'industry');
    }

    public function categoryName()
    {
        return $this->belongsTo(ProductCategory::class,'category');
    }

}
