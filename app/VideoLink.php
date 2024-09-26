<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoLink extends Model
{
    protected $table = 'video_link';

    protected $fillable = ['id','title','type','video_link','thumbnail','short_description','sort_order'];
}
