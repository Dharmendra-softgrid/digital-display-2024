<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SuccessStories;
use App\IndustryImages;
use App\IndustryVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class SuccessStoryController extends Controller
{
    public function index()
    {

        $data['successstories'] = SuccessStories::orderBy('id', 'DESC')->paginate(15);
        return view('admin.successstories.index', $data);
    }
    public function create()
    {

        $data[] = [];
        return view('admin.successstories.form', $data);
    }
    public function edit($id)
    {
        $data['successstory'] = SuccessStories::find($id);
        return view('admin.successstories.form', $data);
    }
    public function store(Request $request)
    {
        //dd($request->file('bannerimage'));
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );

        $rules = [
            'title' => 'required|max:255',
            'content' => 'required'
        ];
        if ($request->file('bannerimage')) {
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validated = $request->validate($rules, $messages);


        if (!empty($request->id)) {
            $successstory = SuccessStories::find($request->id);

            if (!$successstory) {
                return back()->with('error', 'industry not found.');
            }
            if (empty($successstory->slug)) {
                $successstory->slug = str_slug($request->title);
            } else {
                $successstory->slug = str_slug($request->title);
            }
        } else {
            $successstory = new SuccessStories();
            $successstory->slug = str_slug($request->title);
        }
        if ($request->file('bannerimage')) {
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/', $fileName);
            $successstory->banner_image = $fileName;
        }

        // Initialize an array to hold the combined data
        $sections = [];
        $sectionId = 1;

        // Combine the data into a single array
        if (!empty($request->input('iimage'))) {
            foreach ($request->input('ititle') as $index => $title) {
                // Check if any of the fields are not empty or null
                if (!empty($title) || !empty($request->input('icontent')[$index]) || !empty($request->input('iimage')[$index])) {
                    $sections[] = [
                        'isectionid' => $sectionId,
                        'ititle' => $title,
                        'icontent' => $request->input('icontent')[$index],
                        'iimage' => $request->input('iimage')[$index] ?? null, // Default to null if image is not provided
                    ];
                    $sectionId++; // Increment section ID for the next valid section
                }
            }
        }
        // Convert the array to JSON
        $sectionsJson = json_encode($sections);
        $successstory->title = $request->title;
        // $industry->meta_title = $request->meta_title;
        // $industry->meta_keywords = $request->meta_keywords;
        // $industry->meta_description = $request->meta_description;
        $successstory->banner_section = $sectionsJson ?? '';
        $successstory->content = $request->content;
        // $successstory->short_description = $request->short_description;
        // $successstory->company = $request->company;
        // $successstory->year = $request->year;
        // $successstory->type = $request->type;
        $successstory->active = '1';
        $successstory->save();

        return redirect()->route('successstory.index')->with('success', "Success story saved successfully.");
    }
    public function destroy(Request $request, $id)
    {
        $category = SuccessStories::find($id);
        $category->delete();
        return redirect()->route('successstory.index')->with('success', "Success story Deleted successfully.");
    }
}
