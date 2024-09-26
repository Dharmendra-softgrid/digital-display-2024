<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolutionDetail extends Model
{
    protected $table = 'solution_detail';
    protected $fillable = ['id','display_solution_id','heading','content','image'];
    protected $searchable = [
        
    ];
}
