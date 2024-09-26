<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Settings;
use App\Menu;
use App\Pages;
use App\Industries;
use App\ProductCategory;
use App\Product;
use App\Newsroom;
use App\DisplaySolution;
use App\InquireNow;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| HomeController
|--------------------------------------------------------------------------
| Author : Dharmendra Upadhyay
| Last Commited :28/02/2024
| Controller for creating, updating, fetching, and deleting home page data for the application..
|
*/
class HomeController extends Controller
{
    public function index() {
       // $data = DisplaySolution::truncate();
    //    $query = "UPDATE `menu` SET `slug` = 'roombook' WHERE `menu`.`id` = 45;";
    //    DB::update($query);
       
        $products = Product::get();
        $data['product_count'] = count($products);
        $enquiry = InquireNow::get();
        $data['enquiry'] = count($enquiry);
        $user = Auth::user();
        return view('admin.home',$data);
    }

    public function changepassword() {
      return view('auth.passwords.change', [
        'title' => 'Change Password'
      ]);
    }
    public function sociallinks() {
        $data['facebook'] = Settings::where('type','sociallinks')->where('skey','facebook')->first();
        $data['instagram'] = Settings::where('type','sociallinks')->where('skey','instagram')->first();
        $data['linkedin'] = Settings::where('type','sociallinks')->where('skey','linkedin')->first();
        $data['twitter'] = Settings::where('type','sociallinks')->where('skey','twitter')->first();
        $data['youtube'] = Settings::where('type','sociallinks')->where('skey','youtube')->first();
      return view('admin.footer-sociallinks', $data);
    }
    public function sociallinksSave(Request $request) {
        if(!empty($request->facebook)){
            Settings::updateOrCreate(
                ['type' => 'sociallinks', 'skey' => 'facebook'],
                ['svalue' => $request->facebook]
            );
        }
        if(!empty($request->instagram)){
            Settings::updateOrCreate(
                ['type' => 'sociallinks', 'skey' => 'instagram'],
                ['svalue' => $request->instagram]
            );
        }
        if(!empty($request->linkedin)){
            Settings::updateOrCreate(
                ['type' => 'sociallinks', 'skey' => 'linkedin'],
                ['svalue' => $request->linkedin]
            );
        }
        if(!empty($request->twitter)){
            Settings::updateOrCreate(
                ['type' => 'sociallinks', 'skey' => 'twitter'],
                ['svalue' => $request->twitter]
            );
        }
        if(!empty($request->youtube)){
            Settings::updateOrCreate(
                ['type' => 'sociallinks', 'skey' => 'youtube'],
                ['svalue' => $request->youtube]
            );
        }
        return redirect()->back()->with('success', "Social links saved successfully.");
        
    }

    public function copyright() {
        $data['copyright'] = Settings::where('type','copyright')->where('skey','content')->first();
       
      return view('admin.footer-copyright', $data);
    }
    public function copyrightSave(Request $request) {
        if(!empty($request->content)){
            Settings::updateOrCreate(
                ['type' => 'copyright', 'skey' => 'content'],
                ['svalue' => $request->content]
            );
        }
        
        return redirect()->back()->with('success', "Copyright content saved successfully.");
        
    }
    public function headermenu() {
        $data['menus'] = Menu::where('menu_type','header')->orderBy('sort_order', 'ASC')->where('parent',0)->get();       
        return view('admin.header-menu', $data);
    }
    public function footermenu(Request $request) {
        if($request->isMethod('post')){

        }
        $data['menus'] = Menu::where('menu_type','footer')->get(); 
        $data['pages'] = Pages::orderBy('title','ASC')->get();       
        $data['categories'] = ProductCategory::orderBy('title','ASC')->get();       
        $data['products'] = Product::orderBy('title','ASC')->get();       
        $data['industries'] = Industries::orderBy('title','ASC')->get();       
        $data['newsrooms'] = Newsroom::orderBy('title','ASC')->get();       
        return view('admin.footer-menu', $data);
    }
    public function headermenudelete($id) {
        $menu = Menu::where('id',$id)->first();
        Menu::where('parent',$id)->delete();
        Menu::where('id',$id)->delete();
        $route = $menu->menu_type=='footer' ? 'admin.footer.menu' : 'admin.header.menu';
        $message = "menu and its child menu deleted successfully.";
        if($menu->menu_type=='footer'){
            $message = "menu deleted successfully.";
        }
        return redirect()->route($route)->with('success', $message);
        
    }
    public function headermenucreate($id=0) {
        if($id!=0){
           $data['smenu'] = Menu::where('id',$id)->first(); 
           
        }
        $data['menus'] = Menu::where('menu_type','header')->where('parent',0)->get();       
        $data['pages'] = Pages::orderBy('title','ASC')->get();       
        $data['categories'] = ProductCategory::orderBy('title','ASC')->get();       
        $data['products'] = Product::orderBy('title','ASC')->get();       
        $data['industries'] = Industries::orderBy('title','ASC')->get();       
        $data['newsrooms'] = Newsroom::orderBy('title','ASC')->get();       
        return view('admin.create-header-menu', $data);
    }
    public function menuSave(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'link' => 'required_if:type,custom',
            'sort_order' => 'required',
        ]);

        
        if($request->type == 'custom'){
            $insertvalue['link'] = $request->link;
        }
        if($request->id){
            $menu = Menu::find( $request->id);
        }else{
            $menu = new Menu();
        } 
        $menu->title=$request->title;
        $menu->slug = $this->generateUniqueSlug($request->title, $request->id);
        $menu->type=$request->type;
        $menu->menu_type=$request->menu_type;
        $menu->sort_order = $request->sort_order;
        $menu->link=$request->type == 'custom' ? $request->link : '';
        $menu->parent=$request->menu_type == 'footer' ? 0 : $request->parent;
        $menu->save();
        $route = $request->menu_type =='footer' ? 'admin.footer.menu' : 'admin.header.menu';
        return redirect()->route($route)->with('success', "menu saved successfully.");
        
    }
    public function imageSlider() {
        $data['slides'] = Settings::where('type','HomeSlider')->orderBy('skey')->get();
      return view('admin.home.imageSlider', $data);
    }
    public function sliderOrder(Request $request) {
        if(!empty($request->orders)){
            $orders = array_filter($request->orders); 
            foreach($orders as $i=>$order){
                Settings::where('id',$order)->update(['skey'=>'homeslider'.($i+1)]);
            }      
        }
        return response()->json(['status'=>true],200);
        
    }
    public function imageSliderDelete($id) {
        $sts = Settings::where('type','HomeSlider')->where('id',$id)->delete();
        if($sts){
            return redirect()->route('home.image.slider')->with('success', "Slide delete successfully.");
        }else{
            return redirect()->route('home.image.slider')->with('error', "Error Try again.");
        }
        
    }
    public function imageSliderSaveold(Request $request) {
        $request->merge(['DSI' => array_filter($request->DSI),'MSI' => array_filter($request->MSI)]);
        $validatedData = $request->validate([
            'DSI' => 'required|array|min:1',
            'MSI' => 'required|array|min:1',
        ]);
        
        if(!empty($request->DSI)){
            Settings::where('type','HomeImageSlider')->where('skey','dsi')->delete();
            $insertItems=[];
            foreach ($request->DSI as $key => $item) {
                    $insertItems[] = [
                    'skey' =>"dsi",
                    'svalue' => $item,
                    'type' => "HomeImageSlider",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            Settings::insert($insertItems);         
        }
        if(!empty($request->MSI)){
            Settings::where('type','HomeImageSlider')->where('skey','msi')->delete();
            $insertItems=[];
            foreach ($request->MSI as $key => $item) {
                    $insertItems[] = [
                    'skey' =>"msi",
                    'svalue' => $item,
                    'type' => "HomeImageSlider",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            Settings::insert($insertItems);         
        }
        return redirect()->route('home.image.slider')->with('success', "Images saved successfully.");

    }
    public function imageSliderSave(Request $request) {
        $validatedData = $request->validate([
            'slider_type' => 'required',
            'd_image' => 'required_if:slider_type,1',
            'm_image' => 'required_if:slider_type,1',
            'youtube_url' => 'required_if:slider_type,2',
        ]);
        $values = [
            'slider_type'=>$request->slider_type
            
        ];
        if($request->slider_type == 1){
            $values['d_image'] = $request->d_image;
            $values['m_image'] = $request->m_image;
        }
        if($request->slider_type == 2){
            $values['youtube_url'] = $request->youtube_url;
        }
        $insertItems= [
                'skey' =>"homeslider",
                'svalue' => serialize($values),
                'type' => "HomeSlider",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        Settings::create($insertItems);       
        
        return redirect()->route('home.image.slider')->with('success', "Images saved successfully.");

    }
    public function videoSlider() {
        $data['sliderVideos'] = Settings::where('type','HomeVideoSlider')->get();
      return view('admin.home.videoSlider', $data);
    }
    public function videoSliderSave(Request $request) {
        $request->merge(['videos' => array_filter($request->videos),'videos' => array_filter($request->videos)]);
        $validatedData = $request->validate([
            'videos' => 'required|array|min:1',
        ]);

        
        if(!empty($request->videos)){
            Settings::where('type','HomeVideoSlider')->delete();
            $insertItems=[];
            foreach ($request->videos as $key => $item) {
                $svalue=[
                    'url'=>$item,
                    'title'=>isset($request->vtitle[$key]) ? $request->vtitle[$key] : '',
                    'description'=>isset($request->vdesc[$key]) ? $request->vdesc[$key] : '',
                ];
                    $insertItems[] = [
                    'skey' =>"video",
                    'svalue' => serialize($svalue),
                    'type' => "HomeVideoSlider",
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            Settings::insert($insertItems);         
        }
        
        return redirect()->route('home.video.slider')->with('success', "Video saved successfully.");

    }

    public function changePasswordSubmit(Request $request){
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6',
        ]);
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->current_password, $request->new_password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if(strcmp($request->new_password, $request->confirm_password) != 0){
            //New password must be equal to confirm password
            return redirect()->back()->with("error","New Password must be equal to confirm password.");
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
    private function generateUniqueSlug($title, $id = null) {
        $slug = str_slug($title);
        $originalSlug = $slug;
        $counter = 1;
    
        while (Menu::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
    
        return $slug;
    }
}
