<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Newsroom;
use App\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| NewsroomController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting data news and blogs for the application..
|
*/
class NewsroomController extends Controller
{
    public function index() {
        $data['newsrooms'] = Newsroom::paginate(10);
        
        return view('admin.newsroom.index',$data);
    }
    public function banner() {
        $data['banner'] = Settings::where('type','newsroom')->where('skey','banner')->first();        
        return view('admin.newsroom.banner',$data);
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
                ['type' => 'newsroom', 'skey' => 'banner'],
                ['svalue' => $fileName]
            );
            return redirect()->back()->with('success', "Banner saved successfully.");
        }else{
            return redirect()->back()->with('error', "please upload banner image");
        }
        
    }
    
    public function create() {
        $data = [];
        
        return view('admin.newsroom.form',$data);
    }
    public function edit($id) {
        $data['newsroom'] = Newsroom::find($id); 
        
        return view('admin.newsroom.form',$data);
    }
    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:255',         
        ];
        if(!$request->id){
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:10000';
        }
        $messages = array(
            
        );
        $validated = $request->validate($rules,$messages);   
        if(!$request->id){
            if (Newsroom::where('slug', '=', str_slug($request->title))->exists()) {
               return redirect()->back()->withInput($request->input())->with('error','Newsroom  already exists.');
            }
        }
        
        

        if(!empty($request->id)){
            $newsroom = Newsroom::find($request->id);             
            if(!$newsroom){
                return back()->with('error','Newsroom  not found.');
            }
        }else{
            $newsroom = new Newsroom(); 
            $newsroom->slug = str_slug($request->title);
        }
        if($request->file('image')){
            $fileName   =   time() . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $res        =   $request->file('image')->move(public_path() . '/images/' , $fileName);
            $newsroom->image = $fileName;
        }
        $newsroom->title = $request->title;
        $newsroom->meta_title = $request->meta_title;
        $newsroom->meta_keywords = $request->meta_keywords;
        $newsroom->meta_description = $request->meta_description;
        $newsroom->content = $request->content;
        $newsroom->publisher = $request->publisher;
        $newsroom->link = $request->link;
        $newsroom->short_description = $request->short_description;
        $newsroom->save();
        
        return redirect()->route('newsroom.index')->with('success', "Newsroom saved successfully.");        
        
    }
    public function destroy(Request $request,$id) {
        $newsroom = Newsroom::find($id);
        $newsroom->delete();
        return redirect()->back()->with('success', "Newsroom Deleted successfully.");
    }
    

    
}
