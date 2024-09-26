<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\ProductImages;
use App\ProductCategory;
use App\ProductVideos;
use App\ProductSpecifications;
use App\ProductBlog;
use App\Menu;
use App\ProfessionalDisplaySolution;


class DisplaySolution extends Model
{
    
    protected $table = 'display_solution';
    protected $fillable = ['id','title','slug','meta_title','meta_keywords','meta_description','content','image','short_description','bannerimage','banner_title','banner_short_description','display_at_homepage','sort_order','short_desc_home','at_solutions','order_display','banner_section'];
    protected $searchable = [
        
    ];
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
    public function ProfessionalDisplaySolution() {
        return $this->hasMany(ProfessionalDisplaySolution::class,'id', 'solution_id');
    }
    public function SolutionDetail() {
        return $this->hasMany(SolutionDetail::class);
      }
      
}
