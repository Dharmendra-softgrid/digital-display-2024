<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Casestudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| CasestudyController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Here is where you can create, update, fetch, delete your Case studies for your application.
|
*/

class CasestudyController extends Controller
{
    /**
    * Display a listing of the case studies.
    *
    * @return \Illuminate\View\View
    */
    public function index() {
        $data['casestudies'] = Casestudy::orderBy('id', 'DESC')->paginate(15);
        return view('admin.casestudy.index',$data);
    }
    /**
    * Display the form for creating a new case study.
    *
    * @return \Illuminate\View\View
    */
    public function create() {

        $data[] = [];
        return view('admin.casestudy.form',$data);
    }
    /**
    * Display the form for editing an existing case study.
    *
    * @param  int  $id
    * @return \Illuminate\View\View
    */
    public function edit($id) {
        $data['casestudy'] = Casestudy::find($id); 
        return view('admin.casestudy.form',$data);
    }
    /**
    * Store a newly created or updated case study in the database.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(Request $request) {
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        // Validation rules for the request
        $rules=[
            'title' => 'required|max:255',  
            'client_name' => 'required|max:255', 
            'project_year' => 'required|max:255', 
            'project_type' => 'required|max:255',           
            'short_description' => 'required', 
            'content' => 'required', 
        ];
        // Additional validation for banner image
        if($request->file('bannerimage')){
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        // Validate the request data
        $validated = $request->validate($rules,$messages);
        // Check for duplicate case study title
        if(!$request->id){
            if (Casestudy::where('slug', '=', str_slug($request->title))->exists()) {
               return redirect()->back()->withInput($request->input())->with('error','Casestudy  already exists.');
            }
        }
        // Fetch the case study if updating; create a new instance if creating
        if(!empty($request->id)){
            $casestudy = Casestudy::find($request->id);
            
            if(!$casestudy){
                return back()->with('error','case study not valid.');
            }
        }else{
            $casestudy = new Casestudy(); 
            $casestudy->slug = str_slug($request->title);
            
        }
        // Handle banner image upload
        if($request->file('bannerimage')){
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/' , $fileName);
            $casestudy->image = $fileName;
        }
        // Assign values from the request to the case study model
        $casestudy->title = $request->title;
        $casestudy->slug = str_slug($request->title);
        $casestudy->client_name = $request->client_name;
        $casestudy->project_year = $request->project_year;
        $casestudy->project_type = $request->project_type;
        $casestudy->meta_title = $request->meta_title;
        $casestudy->meta_keywords = $request->meta_keywords;
        $casestudy->meta_description = $request->meta_description;
        $casestudy->short_description = $request->short_description;
        $casestudy->content = $request->content;
        $casestudy->active = '1';    
        // Save the case study to the database    
        $casestudy->save();      
        // Redirect to the case study index page with success message
        return redirect()->route('casestudy.index')->with('success', "Case study saved successfully.");   
    }
    /**
    * Remove the specified case study from the database.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(Request $request,$id) {
        $category = Casestudy::find($id);
        $category->delete();
        return redirect()->route('casestudy.index')->with('success', "Casestudy Deleted successfully.");
    }

    
}
