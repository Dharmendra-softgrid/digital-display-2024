<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Industries;
use App\IndustryImages;
use App\IndustryVideos;
use App\IndustryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| IndustryController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting industry data for the application..
|
*/
class IndustryController extends Controller
{
    public function index() {

        $data['industries'] = Industries::orderBy('id', 'ASC')->paginate(15);
        return view('admin.industries.index',$data);
    }
    public function create() {

        $data[] = [];
        return view('admin.industries.form',$data);
    }
    public function edit($id) {
        $data['industry'] = Industries::find($id); 
        return view('admin.industries.form',$data);
    }
    public function store(Request $request) {
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        
        $rules=[
            'title' => 'required|max:255',
            'content' => 'required',
            //'bannerimage' => 'required'
            //'images' => 'required|array|min:1',         
        ];
        // if($request->file('bannerimage')){
        //     $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        // }
        $validated = $request->validate($rules,$messages);


        if(!empty($request->id)){
            $industry = Industries::find($request->id);
            
            if(!$industry){
                return back()->with('error','industry not found.');
            }
            if(empty($industry->slug)) {
                $industry->slug = str_slug($request->title);
            }
        }else{
            $industry = new Industries(); 
            $industry->slug = str_slug($request->title);
            
        }
        // if($request->file('bannerimage')){
        //     $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
        //     $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
        //     $industry->banner_image = $fileName;
        // }
        // if($request->file('icon')){
        //     $fileName   =   time() . uniqid() . '.' . $request->file('icon')->getClientOriginalExtension();
        //     $res        =   $request->file('icon')->move(public_path() . '/images/' , $fileName);
        //     $industry->icon = $fileName;
        // }
        $sections = [];
        $sectionId = 1;

        // Combine the data into a single array
        if (!empty($request->input('bimage'))) {
            foreach ($request->input('btitle') as $index => $title) {
                // Check if any of the fields are not empty or null
                if (!empty($title) || !empty($request->input('bcontent')[$index]) || !empty($request->input('bimage')[$index])) {
                    $sections[] = [
                        'bsectionid' => $sectionId,
                        'btitle' => $title,
                        'bcontent' => $request->input('bcontent')[$index],
                        'bimage' => $request->input('bimage')[$index] ?? null, // Default to null if image is not provided
                    ];
                    $sectionId++; // Increment section ID for the next valid section
                }
            }
        }
        // Convert the array to JSON
        $sectionsJson = json_encode($sections);
        $industry->banner_section = $sectionsJson ?? '';
        $industry->title = $request->title;
        $industry->heading = $request->heading;
        // $industry->sub_heading = $request->sub_heading;
        $industry->meta_title = $request->meta_title;
        $industry->meta_keywords = $request->meta_keywords;
        $industry->meta_description = $request->meta_description;
        $industry->content = $request->content;
        $industry->active = '1';
        $industry->save();

        if(!empty($request->id)){
            IndustryImages::where('industry_id',$request->id)->delete();
            IndustryVideos::where('industry_id',$request->id)->delete();
        }
        //dd($request->images);
        // if(!empty($request->images)){
        //     foreach ($request->images as $key => $image) {
        //             $insertarray[] = [
        //             'industry_id' => $industry->id,
        //             'image' => $image,
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ];
        //     }
        //         IndustryImages::insert($insertarray);
         
        // }
        // if(!empty($request->videos)){
        //     foreach ($request->videos as $key => $videos) {
        //             $insertvideos[] = [
        //             'industry_id' => $industry->id,
        //             'video' => $videos,
        //             'title' => isset($request->vtitle[$key]) ? $request->vtitle[$key] : '',
        //             'description' => isset($request->vdesc[$key]) ? $request->vdesc[$key] : '',
        //             'type' => 'youtube',
        //             'created_at' => date('Y-m-d H:i:s'),
        //             'updated_at' => date('Y-m-d H:i:s'),
        //         ];
        //     }
        //         IndustryVideos::insert($insertvideos);
         
        // }
        if(!empty($request->id)){
            IndustryDetail::where('industries_id',$request->id)->delete();
        }
        if(!empty($request->iimage)){
            foreach ($request->iimage as $key => $image) {
                if(!empty($image)){
                    $insertindustrydetails = [
                        'industries_id' => $industry->id,
                        'title' => isset($request->ititle[$key]) ? $request->ititle[$key]:'',
                        'content' => isset($request->icontent[$key]) ? $request->icontent[$key]:'',
                        'image' => $image,
                        'position' => isset($request->iposition[$key]) ? $request->iposition[$key]:'',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    IndustryDetail::create($insertindustrydetails); 
                }
                    
            }
                    
        }
        return redirect()->route('industry.index')->with('success', "Industry saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $category = Industries::find($id);
        //$category->specifications()->delete();
        $category->delete();
        return redirect()->route('industry.index')->with('success', "Industry Deleted successfully.");
    }

    
}
