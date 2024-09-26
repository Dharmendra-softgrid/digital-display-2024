<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['videos'] = Video::orderBy('id', 'DESC')->paginate(15);
        return view('admin.video.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data[] = [];
        return view('admin.video.form',$data);
    }

    public function edit($id) {
        $data['Video'] = Video::find($id); 
        return view('admin.video.form',$data);
    }
    public function store(Request $request) {
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        
        $rules=[
            'title' => 'required|max:255',
            'type' => 'required'
        ];
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:mp4|max:51200';
        }
        $validated = $request->validate($rules,$messages);


        if(!empty($request->id)){
            $video = Video::find($request->id);
            
            if(!$video){
                return back()->with('error','video not found.');
            }
            if(empty($video->slug)) {
                $video->slug = str_slug($request->title);
            }
        }else{
            $video = new Video(); 
            $video->slug = str_slug($request->title);
            
        }
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/videos/' , $fileName);
            $video->video = $fileName;
        }
        $video->title = $request->title;
        // $industry->meta_title = $request->meta_title;
        // $industry->meta_keywords = $request->meta_keywords;
        // $industry->meta_description = $request->meta_description;
        $video->short_description = $request->short_description;
        $video->active = '1';
        $video->type = $request->type;
        $video->save();      

        return redirect()->route('video.index')->with('success', "video saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $video = Video::find($id);
        $video->delete();
        return redirect()->route('video.index')->with('success', "video deleted successfully.");
    }

    
}
