<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ProductCategoriesController extends Controller
{
    public function index() {
        $data['productCategories'] = ProductCategory::all();
        return view('admin.products.categories.index',$data);
    }
    public function show() {
        $data['productCategories'] = ProductCategory::all();
        return view('admin.products.categories.index',$data);
    }
    public function create() {
        $data = [];
        return view('admin.products.categories.form',$data);
    }
    public function edit($id) {
        $data['category'] = ProductCategory::find($id); 
        return view('admin.products.categories.form',$data);
    }
    public function store(Request $request) {
        $rules=[
            'title' => 'required|max:255',          
        ];

        $messages=['title.required'=>'Please enter title.'];
        $validated = $request->validate($rules,$messages);

        if(!empty($request->id)){
            $category = ProductCategory::find($request->id);             
            if(!$category){
                return back()->with('error','Category not found.');
            }
        }else{
            $category = new ProductCategory(); 
            $category->slug = str_slug($request->title);
        }
        $category->title = $request->title;
        
        $category->save();
        return redirect()->route('productCategory.index')->with('success', "Category saved successfully.");
        
        
    }
    public function destroy(Request $request,$id) {
        $category = ProductCategory::find($id);
        $category->delete();
        return redirect()->route('productCategory.index')->with('success', "Category Deleted successfully.");
    }

    
}
