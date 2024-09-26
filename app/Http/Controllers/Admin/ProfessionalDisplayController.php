<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProfessionalDisplaySolution;
use App\DisplaySolution;
use App\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| ProfessionalDisplayController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting data news and blogs for the application..
|
*/
class ProfessionalDisplayController extends Controller
{
    public function index() {
        $data = [];
        $data['profDisplay'] = ProfessionalDisplaySolution::paginate(10);
        $data['DisplaySolution'] = DisplaySolution::with('ProfessionalDisplaySolution')->get();
        return view('admin.professionalDisplay.index',$data);
    }
    public function banner() {
        $data = [];
        $data['banner'] = Settings::where('type','professionalDisplay')->where('skey','banner')->first();  
        return view('admin.professionalDisplay.banner',$data);
    }
    public function bannerstore(Request $request) {
        $rules['bannerimage'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';        
        $messages = array(            
        );
        $validated = $request->validate($rules,$messages);   
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            
            Settings::updateOrCreate(
                ['type' => 'professionalDisplay', 'skey' => 'banner'],
                ['svalue' => $fileName]
            );
            return redirect()->back()->with('success', "Banner saved successfully.");
        }else{
            return redirect()->back()->with('error', "please upload banner image");
        }
        
    }
    
    public function create() {
        $data = [];
        $data['DisplaySolution'] = DisplaySolution::with('ProfessionalDisplaySolution')->get();
        return view('admin.professionalDisplay.form',$data);
    }
    public function edit($id) {
        $data = [];
        $data['profDisplay'] = ProfessionalDisplaySolution::find($id); 
        $data['DisplaySolution'] = DisplaySolution::with('ProfessionalDisplaySolution')->get();
        return view('admin.professionalDisplay.form',$data);
    }
    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:255',
            'short_description' => 'required',            
            'content' => 'required',            
        ];
        if(!$request->id){
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:10000';
        }
        if($request->file('banner')){
            $rules['banner'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $messages = array(
            
        );
        $validated = $request->validate($rules,$messages);   
        if(!$request->id){
            if (ProfessionalDisplaySolution::where('slug', '=', str_slug($request->title))->exists()) {
               return redirect()->back()->withInput($request->input())->with('error','Professional Display Solution  already exists.');
            }
        }
        
        if(!empty($request->id)){
            $professionalDisplay = ProfessionalDisplaySolution::find($request->id);             
            if(!$professionalDisplay){
                return back()->with('error','Professional Display Solution  not found.');
            }
        }else{
            $professionalDisplay = new ProfessionalDisplaySolution(); 
            $professionalDisplay->slug = str_slug($request->title);
        }
        if($request->file('image')){
            $fileName   =   time() . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $res        =   $request->file('image')->move(public_path() . '/images/' , $fileName);
            $professionalDisplay->image = $fileName;
        }
        if($request->file('banner')){
            $fileName   =   time() . uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
            $res        =   $request->file('banner')->move(public_path() . '/images/' , $fileName);
            $professionalDisplay->banner = $fileName;
        }
        $professionalDisplay->title = $request->title;
        $professionalDisplay->solution_id = $request->solution_id;
        $professionalDisplay->meta_title = $request->meta_title;
        $professionalDisplay->meta_keywords = $request->meta_keywords;
        $professionalDisplay->meta_description = $request->meta_description;
        $professionalDisplay->content = $request->content;
        $professionalDisplay->short_description = $request->short_description;
        $professionalDisplay->banner_title = $request->banner_title;
        $professionalDisplay->banner_short_description = $request->banner_short_description;
        $professionalDisplay->save();
        
        return redirect()->route('professionalDisplay.index')->with('success', "Professional Display Solution saved successfully.");        
        
    }
    public function destroy(Request $request,$id) {
        $professionalDisplay = ProfessionalDisplaySolution::find($id);
        $professionalDisplay->delete();
        return redirect()->back()->with('success', "Professional Display Solution Deleted successfully.");
    }
    

    
}
