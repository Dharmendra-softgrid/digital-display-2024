<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IndustryBlog;
use App\Industries;

/*
|--------------------------------------------------------------------------
| IndustryBlogController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting industry blogs data for the application..
|
*/
class IndustryBlogController extends Controller
{
    public function index() {
        $Industries = Industries::with('IndustryBlog')->get();
        $IndustryBlog = IndustryBlog::orderBy('id', 'DESC')->paginate(15);
        return view('admin.industryBlog.index',compact('IndustryBlog','Industries'));
    }
    public function create() {
        $data[] = [];
        $data['industries'] = Industries::with('IndustryBlog')->get();
        return view('admin.industryBlog.form',$data);
    }
    public function edit($id) {
        $data['IndustryBlog'] = IndustryBlog::find($id); 
        $data['industries'] = Industries::with('IndustryBlog')->get();
        return view('admin.industryBlog.form',$data);
    }
    public function store(Request $request) {
        
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        
        $rules=[
            'title' => 'required|max:255',
            'description' => 'required'
        ];
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validated = $request->validate($rules,$messages);


        if(!empty($request->id)){
            $IndustryBlog = IndustryBlog::find($request->id);
            
            if(!$IndustryBlog){
                return back()->with('error','Image not found.');
            }
            if(empty($IndustryBlog->slug)) {
                $IndustryBlog->slug = str_slug($request->title);
            }
        }else{
            $IndustryBlog = new IndustryBlog(); 
            $IndustryBlog->slug = str_slug($request->title);
            
        }
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            $IndustryBlog->image = $fileName;
        }
        $IndustryBlog->title = $request->title;
        $IndustryBlog->industry_id = $request->industry_id;
        $IndustryBlog->description = $request->description;
        $IndustryBlog->save();      

        return redirect()->route('industryBlog.index')->with('success', "Bolg saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $IndustryBlog = IndustryBlog::find($id);
        $IndustryBlog->delete();
        return redirect()->route('industryBlog.index')->with('success', "Image deleted successfully.");
    }
}
