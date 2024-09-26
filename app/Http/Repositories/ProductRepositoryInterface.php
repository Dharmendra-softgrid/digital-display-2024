<?php
namespace App\Http\Repositories;
use Illuminate\Http\Request;
interface ProductRepositoryInterface{
    public function index(Request $request);
    public function create();
    public function edit($id);
    public function store(Request $request);
    public function destroy(Request $request, $id);
    public function destroyComponent($id);
    public function getSpecifications(Request $request);
    public function destroyBrochures($id);
    public function destroyKeyFeatureSection($id);
    public function fetchData(Request $request);
    public function fetchKeyFeatureSectionData(Request $request);
    public function fetchBrochuresData(Request $request);
    public function fetchKeyFeatureDescData(Request $request);
    public function delete($id);
}

