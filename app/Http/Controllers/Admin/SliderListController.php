<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\IndustryImages;
use App\IndustryVideos;
use App\Pages;
use App\Industries;
use App\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SliderListController extends Controller
{
    public function index(Request $request) {

        $data['sliders'] = Slider::where('type', $request->input('type'))->orderBy('id', 'DESC')->paginate(15);
        return view('admin.sliderList.index',$data);
    }
    public function create() {
        $data[] = [];
        
        
        $data['pages'] = Pages::orderBy('title','ASC')->get();   
        $data['industries'] = Industries::orderBy('title','ASC')->get();    
        $data['solutions'] = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        return view('admin.sliderList.form',$data);
    }
    public function edit($id) {
        
        $data['slider'] = Slider::find($id); 
        $data['pages'] = Pages::orderBy('title','ASC')->get();   
        $data['industries'] = Industries::orderBy('title','ASC')->get();   
        $data['solutions'] = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        return view('admin.sliderList.form',$data);
    }
    public function store(Request $request) {

        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        
        $rules=[
           
        ];
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:13000';
        }
        $validated = $request->validate($rules,$messages);

        if(!empty($request->id)){
            $slider = Slider::find($request->id);
            
            if(!$slider){
                return back()->with('error','Slide not found.');
            }
            if(empty($slider->slug)) {
                $slider->slug = str_slug($request->title);
            }
        }else{
            $slider = new Slider(); 
            $slider->slug = str_slug($request->title);
            
        }
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            $slider->image = $fileName;
        }
        $slider->slide_title = $request->title;
        // $industry->meta_title = $request->meta_title;
        // $industry->meta_keywords = $request->meta_keywords;
        // $industry->meta_description = $request->meta_description;
        $slider->slide_content = $request->content;
        $slider->status = '1';
        $slider->type = $request->type;
        $slider->save();      

        return redirect()->route('slider.index')->with('success', "Slide saved successfully.");   
    }
    public function destroy(Request $request,$id) {
        $category = Slider::find($id);
        $category->delete();
        return redirect()->route('slider.index')->with('success', "Slide deleted successfully.");
    }
}
