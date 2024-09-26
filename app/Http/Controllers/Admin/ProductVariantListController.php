<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ProductVariantList;
use App\Http\Controllers\Controller;

class ProductVariantListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['productVariantList'] = ProductVariantList::all();
        return view('admin.products.variant.index',$data);
    }
    public function show() {
        $data['productVariantList'] = ProductVariantList::all();
        return view('admin.products.variant.index',$data);
    }
    public function create() {
        $data = [];
        return view('admin.products.variant.form',$data);
    }
    public function edit($id) {
        $data['variant'] = ProductVariantList::find($id); 
        return view('admin.products.variant.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules=[
            'name' => 'required|max:255',          
        ];

        $messages=['name.required'=>'Please enter name.'];
        $validated = $request->validate($rules,$messages);

        if(!empty($request->id)){
            $variant = ProductVariantList::find($request->id);             
            if(!$variant){
                return back()->with('error','Variant not found.');
            }
        }else{
            $variant = new ProductVariantList(); 
        }
        $variant->name = $request->name;
        
        $variant->save();
        return redirect()->route('productVariantList.index')->with('success', "Variant saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $variant = ProductVariantList::find($id);
        $variant->delete();
        return redirect()->route('productVariantList.index')->with('success', "Variant Deleted successfully.");
    }
}
