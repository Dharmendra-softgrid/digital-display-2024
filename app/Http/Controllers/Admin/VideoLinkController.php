<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VideoLink;

class VideoLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['VideoLink'] = VideoLink::orderBy('id', 'DESC')->paginate(15);
        return view('admin.videoLink.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data[] = [];
        return view('admin.videoLink.form',$data);
    }

    public function edit($id) {
        $data['VideoLink'] = VideoLink::find($id); 
        return view('admin.videoLink.form',$data);
    }
    public function store(Request $request) {
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        
        $rules=[
            'title' => 'required|max:255',
            'type' => 'required',
            'sort_order' => 'required'
        ];
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validated = $request->validate($rules,$messages);


        if(!empty($request->id)){
            $VideoLink = VideoLink::find($request->id);
            
            if(!$VideoLink){
                return back()->with('error','Video Link not found.');
            }
            if(empty($VideoLink->slug)) {
                $VideoLink->slug = str_slug($request->title);
            }
        }else{
            $VideoLink = new VideoLink(); 
            $VideoLink->slug = str_slug($request->title);
            
        }
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            $VideoLink->thumbnail = $fileName;
        }
        $VideoLink->title = $request->title;
        $VideoLink->link = $request->link;
        // $industry->meta_title = $request->meta_title;
        // $industry->meta_keywords = $request->meta_keywords;
        // $industry->meta_description = $request->meta_description;
        $VideoLink->short_description = $request->short_description;
        $VideoLink->active = '1';
        $VideoLink->type = $request->type;
        $VideoLink->sort_order = $request->sort_order;
        $VideoLink->save();      

        return redirect()->route('videoLink.index')->with('success', "Video Link saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $VideoLink = VideoLink::find($id);
        $VideoLink->delete();
        return redirect()->route('videoLink.index')->with('success', "Video Link deleted successfully.");
    }

    
}
