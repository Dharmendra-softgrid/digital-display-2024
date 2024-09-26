<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings;
use App\InquireNow;
use App\Contacts;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ContactusController extends Controller
{
    public function Settings() {
        $contactSettings = Settings::where('type','contact')->get();
        
        if($contactSettings->isNotEmpty()){
            $data = $contactSettings->pluck('svalue','skey');
        }
       
        
        return view('admin.contact.settings',$data);
    }
    public function SocialLinks() {
        $sociallinks = Settings::where('type','sociallinks')->get();
        
        if($sociallinks->isNotEmpty()){
            $data = $sociallinks->pluck('svalue','skey');
        }
       
        
        return view('admin.contact.sociallinks',$data);
    }

    public function list() {
        
       $data['contacts']=InquireNow::orderBy('id','DESC')->paginate(15);
        
        return view('admin.contact.index',$data);
    }
    public function export() {
        
       $contacts=DB::table('inquiry')->select(DB::raw("CONCAT(first_name,' ',last_name) as name"),'email','phone','city','company','interested_category','interested_subcategory','product',DB::raw("DATE_FORMAT(inquiry.created_at,'%d %b %Y %H:%i:%s') as date"))
       ->orderBy('inquiry.id','DESC')->get()->toarray();
       $fileName = 'inquiry.csv';
       $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

       $columns = array('Name', 'Email', 'Phone','City','Company','Interested Category','Interested Sub-Category','Product','Date');

       
            $file = fopen(public_path($fileName), 'w');
            fputcsv($file, $columns);
            foreach ($contacts as $contact) {
                fputcsv($file, (array)$contact);
            }

            fclose($file);
       

        return response()->download(public_path($fileName) , $fileName, $headers);
        
        
    }
    
    
    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',                   
        ]); 

        $setting = Settings::firstOrNew(array('type' => 'contact','skey' => 'email'));
        $setting->svalue = $request->email;
        $setting->save();  

        $setting = Settings::firstOrNew(array('type' => 'contact','skey' => 'mobile'));
        $setting->svalue = $request->mobile;
        $setting->save();

        $setting = Settings::firstOrNew(array('type' => 'contact','skey' => 'address'));
        $setting->svalue = $request->address;
        $setting->save();

        // $setting = Settings::firstOrNew(array('type' => 'contact','skey' => 'description'));
        // $setting->svalue = $request->desc;
        // $setting->save();  


        
        return redirect()->route('contact.settings')->with('success', "Contact Settings saved successfully.");        
        
    }
    public function storeSocialLinks(Request $request) {
        $validated = $request->validate([
            'facebook' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',                   
            'twitter' => 'required',                   
            'youtube' => 'required',                   
        ]); 

        $setting = Settings::firstOrNew(array('type' => 'sociallinks','skey' => 'facebook'));
        $setting->svalue = $request->facebook;
        $setting->save();  

        $setting = Settings::firstOrNew(array('type' => 'sociallinks','skey' => 'instagram'));
        $setting->svalue = $request->instagram;
        $setting->save();

        $setting = Settings::firstOrNew(array('type' => 'sociallinks','skey' => 'linkedin'));
        $setting->svalue = $request->linkedin;
        $setting->save();

        $setting = Settings::firstOrNew(array('type' => 'sociallinks','skey' => 'twitter'));
        $setting->svalue = $request->twitter;
        $setting->save();  

        $setting = Settings::firstOrNew(array('type' => 'sociallinks','skey' => 'youtube'));
        $setting->svalue = $request->youtube;
        $setting->save();  
        
        return redirect()->route('sociallinks')->with('success', "Social Links saved successfully.");        
        
    }
    
    
}
