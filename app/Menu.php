<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\DisplaySolution;

class Menu extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'link', 'type', 'parent', 'menu_type', 'slug', 'menu_id', 'slug', 'page', 'sort_order'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $table = 'menu';

    public function parent()
    {
        return $this->belongsToOne(static::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent');
    }

    public function displaySolution()
    {
        return $this->hasMany(DisplaySolution::class, 'menu_id', 'id');
    }
}
