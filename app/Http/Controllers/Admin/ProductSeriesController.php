<?php

namespace App\Http\Controllers\Admin;

use App\ProductSeries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;

class ProductSeriesController extends Controller
{
    public function index() {
        $data['productSeries'] = ProductSeries::all();
        return view('admin.products.series.index',$data);
    }
    public function show() {
        $data['productSeries'] = ProductSeries::all();
        return view('admin.products.series.index',$data);
    }
    public function create() {
        $data = [];
        $data['categories'] = ProductCategory::all();
        return view('admin.products.series.form',$data);
    }
    public function edit($id) {
        $data['series'] = ProductSeries::find($id);
        $data['categories'] = ProductCategory::all(); 
        return view('admin.products.series.form',$data);
    }
    public function store(Request $request) {
        $rules=[
            'name' => 'required|max:255',       
        ];

        $messages=['name.required'=>'Please enter name.'];
        $validated = $request->validate($rules,$messages);

        if(!empty($request->id)){
            $series = ProductSeries::find($request->id);             
            if(!$series){
                return back()->with('error','Variant not found.');
            }
        }else{
            $series = new ProductSeries(); 
        }
        $series->name = $request->name;
        $series->category_id = $request->category_id;
        $series->save();
        return redirect()->route('productSeries.index')->with('success', "series saved successfully.");
    }
    public function destroy(Request $request,$id) {
        $series = ProductSeries::find($id);
        $series->delete();
        return redirect()->route('productSeries.index')->with('success', "Series Deleted successfully.");
    }
}
