<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Industries;
class IndustryBlog extends Model
{
    protected $table = 'industry_blog';
    protected $fillable = ['id','industry_id','title','slug','description','image'];

    public function Industries(){
        return $this->belongsTo(Industries::class,'industry_id','id');
    }
}
