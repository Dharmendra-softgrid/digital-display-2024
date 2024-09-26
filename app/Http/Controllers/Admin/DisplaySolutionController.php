<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DisplaySolution;
use App\SolutionDetail;
use App\Settings;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| DisplaySolutionController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting display solutions for the application..
|
*/

class DisplaySolutionController extends Controller
{
    /**
     * Display a listing of the display solutions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dat = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        // echo '<pre>';
        // print_r($dat);echo '</pre>';die;
        $data['menus'] = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        $data['displaysolutions'] = DisplaySolution::paginate(10);
        return view('admin.displaysolution.index', $data);
    }
    /**
     * Display the form for managing the banner.
     *
     * @return \Illuminate\View\View
     */
    public function banner()
    {
        $data['banner'] = Settings::where('type', 'newsroom')->where('skey', 'banner')->first();
        return view('admin.displaysolution.banner', $data);
    }
    /**
     * Store the banner image in the settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bannerstore(Request $request)
    {
        $rules['bannerimage'] = 'required|mimes:jpeg,png,jpg,gif|max:2048';
        $messages = array();
        $validated = $request->validate($rules, $messages);
        if ($request->file('bannerimage')) {
            $fileName   =   time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res        =   $request->file('bannerimage')->move(public_path() . '/images/', $fileName);

            Settings::updateOrCreate(
                ['type' => 'displaysolution', 'skey' => 'banner'],
                ['svalue' => $fileName]
            );
            return redirect()->back()->with('success', "Banner saved successfully.");
        } else {
            return redirect()->back()->with('error', "please upload banner image");
        }
    }

    public function create()
    {
        $data = [];
        $data['menus'] = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        return view('admin.displaysolution.form', $data);
    }
    public function edit($id)
    {
        $data['menus'] = Menu::whereIn('type', ['page.solutions', 'custom'])->get();
        $data['displaysolution'] = DisplaySolution::find($id);

        return view('admin.displaysolution.form', $data);
    }
    public function store(Request $request)
    {
        $title = Menu::where('id', $request->menu_id)->value('title');
        $rules = [
            'short_description' => 'required',
            'content' => 'required',
            'design' => 'required',
        ];
        if (!$request->id) {
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif|max:10000';
        }
        if ($request->file('bannerimage')) {
            $rules['bannerimage'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $messages = array(
            // Add your custom validation messages here if needed
        );

        $this->validate($request, $rules, $messages);

        if (!empty($request->id)) {
            $displaysolution = DisplaySolution::find($request->id);
            if (!$displaysolution) {
                return back()->with('error', 'Display Solution not found.');
            }
        } else {
            $displaysolution = new DisplaySolution;
        }

        if ($request->file('image')) {
            $fileName = time() . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $res = $request->file('image')->move(public_path() . '/images/', $fileName);
            $displaysolution->image = $fileName;
        }
        if ($request->file('bannerimage')) {
            $fileName = time() . uniqid() . '.' . $request->file('bannerimage')->getClientOriginalExtension();
            $res = $request->file('bannerimage')->move(public_path() . '/images/', $fileName);
            $displaysolution->bannerimage = $fileName;
        }
        $sections = [];
        $sectionId = 1;

        // Combine the data into a single array
        if (!empty($request->input('bimage'))) {
            foreach ($request->input('btitle') as $index => $btitle) {
                if (!empty($title) || !empty($request->input('bcontent')[$index]) || !empty($request->input('bimage')[$index])) {
                    $sections[] = [
                        'bsectionid' => $sectionId,
                        'btitle' => $btitle,
                        'bcontent' => $request->input('bcontent')[$index],
                        'bimage' => $request->input('bimage')[$index] ?? null,
                    ];
                    $sectionId++;
                }
            }
        }
        // Convert the array to JSON
        $sectionsJson = json_encode($sections);

        $gridsections = [];
        $gridsectionId = 1;

        // Combine the data into a single array
        if (!empty($request->input('gimage'))) {
            foreach ($request->input('gtitle') as $index => $gtitle) {
                if (!empty($title) || !empty($request->input('gcontent')[$index]) || !empty($request->input('gimage')[$index])) {
                    $gridsections[] = [
                        'gsectionid' => $gridsectionId,
                        'gtitle' => $gtitle,
                        'gcontent' => $request->input('gcontent')[$index],
                        'gimage' => $request->input('gimage')[$index] ?? null,
                    ];
                    $gridsectionId++;
                }
            }
        }
        // Convert the array to JSON
        $gridsectionsJson = !empty($gridsections) ? json_encode($gridsections) : null;

        $displaysolution->title = $title;
        $displaysolution->slug = $this->generateUniqueSlug($title, $request->id);
        $displaysolution->menu_id = $request->menu_id;
        $displaysolution->display_at_homepage = $request->display_at_homepage;
        $displaysolution->sort_order = $request->sort_order;
        $displaysolution->at_solutions = $request->at_solutions;
        $displaysolution->order_display = $request->order_display;
        $displaysolution->short_desc_home = $request->short_desc_home;
        $displaysolution->meta_title = $request->meta_title;
        $displaysolution->meta_keywords = $request->meta_keywords;
        $displaysolution->meta_description = $request->meta_description;
        $displaysolution->design = $request->design;
        $displaysolution->content = $request->content;
        $displaysolution->short_description = $request->short_description;
        $displaysolution->banner_title = $request->banner_title;
        $displaysolution->banner_short_description = $request->banner_short_description;
        $displaysolution->active = '1';
        $displaysolution->banner_section = $sectionsJson ?? '';
        $displaysolution->grid_section = $gridsectionsJson ?? '';
        $displaysolution->save();

        $menu = Menu::findOrFail($displaysolution->menu_id);
        $menu->page = $displaysolution->id;
        $menu->save();

        if (!empty($request->id)) {
            SolutionDetail::where('display_solution_id', $request->id)->delete();
        }

        if (!empty($request->iimage)) {
            foreach ($request->iimage as $key => $image) {
                if (!empty($image)) {
                    $insertsolutiondetail = [
                        'display_solution_id' => $request->id,
                        'heading' => isset($request->ititle[$key]) ? $request->ititle[$key] : '',
                        'content' => isset($request->icontent[$key]) ? $request->icontent[$key] : '',
                        'image' => $image,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    SolutionDetail::create($insertsolutiondetail);
                }
            }
        }

        return redirect()->route('displaysolution.index')->with('success', "Display Solution saved successfully.");
    }

    public function destroy(Request $request, $id)
    {
        $newsroom = DisplaySolution::find($id);
        $newsroom->delete();
        return redirect()->back()->with('success', "Display Solution Deleted successfully.");
    }
    public function generateUniqueSlug($title, $id = null)
    {
        $slug = str_slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (DisplaySolution::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
