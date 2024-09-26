<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;

class Imageuploader extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index() {}

    public function upload(Request $request) {

        return view('admin.imageuploader.upload', [
            'formhead' => 'Image Upload',
            'imageId' => $request->query('imageId'),
            'imgTagId' => $request->query('imgTagId'),
            'awspath' => $request->query('imagePath'),
            'type' => $request->query('type'),
        ]);
    }

    public function imagesupload(Request $request) {
        if ($request->method() == 'POST') {
            $mime = 'jpeg,png,jpg,gif';
            if($request->type == 'pdf'){
                $mime = 'pdf';
            }
            //dd('mimes:'.$mime.'|max:2048');
            $request->validate([
                'FileInput' => 'required',
                'FileInput' => 'mimes:'.$mime
            ]);
            
            if ($request->file('FileInput')->isValid()) {
                
                $files      =   [];
                $s3_result  =   [];

                // Create Original Image and add to $files for upload
                
                $fileName   =   !empty($request->file_name) ? $request->file_name. '.' . $request->file('FileInput')->getClientOriginalExtension() : $request->file('FileInput')->getClientOriginalName();
                $res        =   $request->file('FileInput')->move(public_path() . '/' . $request->path, $fileName);
                
                if(!empty($res)){                
                    // JSON Response
                    $return = [
                        'status'    =>  true,
                        'filename'  =>  $fileName,
                        'imageId'   =>  $request->input('imageId') ?? '',
                        'imgTagId'  =>  $request->input('imgTagId') ?? '',
                        'url'    =>  asset( '/' . $request->path.'/' . $fileName),
                        'setfile'   =>  true
                    ];
                    exit(json_encode($return));
                }else{
                     $return = [
                        'status'    =>  false,                        
                        'error'   =>  "Error Try again"
                    ];  
                    exit(json_encode($return)); 
                }
                
            }else{
                $return = [
                        'status'    =>  false,                        
                        'error'   =>  "Invalid file"
                    ];  
                    exit(json_encode($return)); 
            }
        }
    }
    
    
    
   
}
