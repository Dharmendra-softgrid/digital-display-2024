<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class PagesController extends Controller
{
    public function index() {

        $data['pages'] = Pages::orderBy('id', 'DESC')->paginate(15);
        return view('admin.pages.index',$data);
    }
    public function create() {

        $data[] = [];
        return view('admin.pages.form',$data);
    }
    public function edit($id) {
        $data['page'] = Pages::find($id); 
        return view('admin.pages.form',$data);
    }
    public function store(Request $request) {
        $rules=[
            'title' => 'required|max:255',         
        ];
        $messages=[
                     
        ];
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif|max:2048';
        }
        $validated = $request->validate($rules,$messages);
        
        if(!empty($request->id)){
            $page = Pages::find($request->id); 
            
            if(!$page){
                return back()->with('error','Page not found.');
            }
        }else{
            $page = new Pages(); 
            $page->slug = str_slug($request->title);
        }
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            $page->banner_image = $fileName;
        }
        $page->title = $request->title;
        $page->meta_title = $request->meta_title;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_description = $request->meta_description;
        $page->save();
        return redirect()->route('page.index')->with('success', "Page Content saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $category = Pages::find($id);
        $category->delete();
        return redirect()->route('page.index')->with('success', "Page Deleted successfully.");
    }

    
}
