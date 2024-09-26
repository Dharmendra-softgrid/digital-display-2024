<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\ProductImages;
use App\ProductVideos;
use App\Industries;
use App\ProductSpecifications;
use App\ProductOtherSpecification;
use App\ProductBlog;
use App\ProductVariant;
use App\ProductVariantList;
use App\ProductComponent;
use App\ProductKeyFeatureDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use Exception;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Facades\Log;
use App\ProductSeries;
use App\Menu;

use Illuminate\Database\QueryException;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pass_array = [];
            $columns = ["id", "title", "series", "featured_image"];
            $orderColumn = $columns[$request->order[0]['column']] ?? $columns[0];
            $orderDir = $request->order[0]['dir'] ?? 'asc';

            // Main query
            $query = DB::table('products')
                ->select(DB::raw('SQL_CALC_FOUND_ROWS products.*'));

            // Apply search filter
            if ($request->search['value']) {
                $search = $request->search['value'];
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('featured_image', 'like', "%{$search}%");
                });
            }

            // Clone query for total count before pagination
            $totalQuery = clone $query;

            // Apply sorting and pagination
            $query->orderBy($orderColumn, $orderDir)
                ->skip($request->start)
                ->limit($request->length);

            // Execute queries
            $results = $query->get();
            $totalRecords = DB::select(DB::raw("SELECT FOUND_ROWS() AS 'total';"))[0]->total;
            $totalFiltered = $totalQuery->count(); // Use the cloned query for total filtered count
            $i = 1;
            foreach ($results as $row) {
                $product_id =  $row->id;
                $editButton = '<a title="edit" href="' . route('product.edit', ['id' => $product_id]) . '" class="btn btn-primary btn-sm mr-1"" data-product_id="' . $product_id . '"><i class="bi bi-pencil"></i></a>';
                $deleteButton = '<button title="delete" type="button" class="btn btn-danger btn-sm delete ml-1" data-product_id="' . $product_id . '"><i class="bi bi-trash"></i></button>';

                $pass_array[] = [
                    'product_id' => $product_id,
                    'id' => $i,
                    'title' => $row->title,
                    'series' => Menu::where('id', $row->series)->value('title'),
                    'featured_image' => asset('images/' . $row->featured_image),
                    'edit_url' => route('product.edit', ['id' => $product_id]),
                ];
                $i++;
            }


            return response()->json([
                "data" => $pass_array,
                "recordsTotal" => $totalRecords,
                "recordsFiltered" => $totalFiltered
            ], 200);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        $data = [];
        $getAllSolutions = Menu::whereIn('parent', [0])->pluck('id');
        $Solutions = Menu::whereIn('parent', [$getAllSolutions])->pluck('id');
        $solData = [];

        foreach ($Solutions as $Solution) {
            $menus = Menu::where('parent', $Solution)->get(['id', 'title']); // Query id and title

            foreach ($menus as $menu) {
                $solData[] = [
                    'id' => $menu->id,
                    'name' => $menu->title,
                ];
            }
        }
        $data['series'] = $solData;
        $data['categories'] = ProductCategory::all();
        $data['variants'] = ProductVariantList::orderByRaw('CAST(name AS UNSIGNED) ASC')->get();
        $data['industries'] = Industries::all();
        return view('admin.products.form', $data);
    }
    public function edit($id)
    {
        //$data['series'] = ProductSeries::all();
        $data['product'] = Product::find($id);
        $data['categories'] = ProductCategory::all();
        $data['product'] = Product::with('variants')->find($id);
        $data['variants'] = ProductVariantList::orderByRaw('CAST(name AS UNSIGNED) ASC')->get();
        $data['industries'] = Industries::all();
        $data['productComponents'] = ProductComponent::where('product_id', $id)->get();
        $data['productBrochures'] = ProductSpecifications::where('title', 'brochures')->where('product_id', $id)->get();
        $getAllSolutions = Menu::whereIn('parent', [0])->pluck('id');
        $Solutions = Menu::whereIn('parent', [$getAllSolutions])->pluck('id');
        $solData = [];

        foreach ($Solutions as $Solution) {
            $menus = Menu::where('parent', $Solution)->get(['id', 'title']); // Query id and title

            foreach ($menus as $menu) {
                $solData[] = [
                    'id' => $menu->id,
                    'name' => $menu->title,
                ];
            }
        }
        $data['series'] = $solData;
        // Example usage of a stdClass object for $product
        return view('admin.products.form', $data);
    }
    public function store(Request $request)
    {

        $messages = array(
            // 'images.required' => 'Atleast 1 image required',
            // 'specifications.required' => 'specification can not be empty',
        );

        $validated = $request->validate([
            'title' => 'required|max:255',
            'short_description' => 'required',
            //'key_features' => 'required',
            //'description' => 'required',
            //'categories' => 'required|array|min:1',
            //'images' => 'required|array|min:1',           
            //'specifications' => 'required|array|min:1',           
        ], $messages);

        if (!empty($request->id)) {
            $product = Product::find($request->id);
            if (!$product) {
                return back()->with('error', 'Product not found.');
            }
        } else {
            $product = new Product();
            $product->slug = str_slug($request->title);
        }

        if ($request->file('featuredimage')) {
            $fileName   =   time() . uniqid() . '.' . $request->file('featuredimage')->getClientOriginalExtension();
            $res        =   $request->file('featuredimage')->move(public_path() . '/images/', $fileName);
            $product->featured_image = $fileName;
        }

        $product->title = $request->title;
        $product->model = $request->model;
        $product->series = $request->series;
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->spec_sheet = $request->specesheetvalue;
        $product->save();
        if (!empty($request->id)) {
            $product->product_categories()->detach($request->categories);
        }
        $product->product_categories()->attach($request->categories);

        if (!empty($request->id)) {
            $product->industries()->detach($request->industries);
        }
        $product->industries()->attach($request->industries);

        if (!empty($request->id)) {
            ProductImages::where('product_id', $request->id)->delete();
        }
        if (!empty($request->images)) {
            foreach ($request->images as $key => $image) {
                $insertarray[] = [
                    'product_id' => $product->id,
                    'image' => $image,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            ProductImages::insert($insertarray);
        }
        if (!empty($request->speceimage)) {
            $product->specificationimage = $request->speceimage;
            $product->save();
        } else {
            $product->specificationimage = "";
            $product->save();
            if (!empty($request->id)) {
                ProductSpecifications::where('product_id', $request->id)->where('type', 'specification')->delete();
            }
            if (!empty($request->specifications)) {
                for ($i = 0; $i <= count($request->specifications); $i++) {
                    if (!empty($request->specifications[$i]) && !empty($request->specificationsvalue[$i])) {
                        $insertspec[] = [
                            'product_id' => $product->id,
                            'title' => $request->specifications[$i],
                            'value' => $request->specificationsvalue[$i],
                            'type' => 'specification',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }
                if (!empty($insertspec)) {
                    ProductSpecifications::insert($insertspec);
                }
            }
        }

        $matchtype = [
            'product_id' => $product->id,
            'title' => 'specesheet',
            'type' => 'resource'
        ];
        $insertspecsheet = ['value' => !empty($request->specesheet) ? serialize($request->specesheet) : ""];
        ProductSpecifications::updateOrCreate($matchtype, $insertspecsheet);

        $matchtype = [
            'product_id' => $product->id,
            'title' => 'casestudy',
            'type' => 'resource'
        ];
        $insertspecsheet = ['value' => !empty($request->casestudy) ? serialize($request->casestudy) : ''];
        ProductSpecifications::updateOrCreate($matchtype, $insertspecsheet);


        //dd(DB::getQuerylog());
        if (!empty($request->id)) {
            ProductSpecifications::where('product_id', $request->id)->where('type', 'accessory')->delete();
        }
        if (!empty($request->accessories)) {
            $insertspec = [];
            for ($i = 0; $i <= count($request->accessories); $i++) {
                if (!empty($request->accessories[$i]) && !empty($request->accessoriesvalue[$i])) {
                    $insertspec[] = [
                        'product_id' => $product->id,
                        'title' => $request->accessories[$i],
                        'value' => $request->accessoriesvalue[$i],
                        'type' => 'accessory',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }
            if (!empty($insertspec)) {
                ProductSpecifications::insert($insertspec);
            }
        }
        if (!empty($request->id)) {
            ProductVideos::where('product_id', $request->id)->delete();
        }
        if (!empty($request->videos)) {
            foreach ($request->videos as $key => $video) {
                $insertvideos[] = [
                    'product_id' => $product->id,
                    'video' => $video,
                    'title' => isset($request->vtitle[$key]) ? $request->vtitle[$key] : '',
                    'description' => isset($request->vdesc[$key]) ? $request->vdesc[$key] : '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            ProductVideos::insert($insertvideos);
        }
        /* Insert key feature section */
        if ($request->has('v_id')) {
            foreach ($request->v_id as $variantId) {
                if (isset($request->blogtitle[$variantId])) {
                    foreach ($request->blogtitle[$variantId] as $index => $title) {
                        if (isset($request->keyFeatureSec_id[$variantId][$index])) {
                            $existingRecord = ProductBlog::where('product_id', $product->id)
                                ->where('variant_id', $variantId)
                                ->where('id', $request->keyFeatureSec_id[$variantId][$index])
                                ->first();
                            if ($existingRecord) {
                                $existingRecord->title = $title;
                                $existingRecord->description = $request->blogdescription[$variantId][$index];
                                $existingRecord->image = $request->blogimage[$variantId][$index] ?? null;
                                $existingRecord->updated_at = date('Y-m-d H:i:s');
                                $existingRecord->save();
                            }
                        } else {
                            if (!empty($title)) {
                                $insertblogs = [
                                    'product_id' => $product->id,
                                    'variant_id' => $variantId,
                                    'title' => $title,
                                    'description' => $request->blogdescription[$variantId][$index],
                                    'image' => $request->blogimage[$variantId][$index] ?? null,
                                    'created_at' => date('Y-m-d H:i:s'),
                                ];
                                ProductBlog::create($insertblogs);
                            }
                        }
                    }
                }
            }
        }
        //When deselect the already selected variant Removing data of component, key feature section, description, brochures. 
        if (!empty($request->variant)) {
            // Get variant from form
            $getVariant = [];
            foreach ($request->variant as $key => $v) {
                if (!empty($v)) {
                    $getVariant[] = [
                        'product_id' => $product->id,
                        'variant_id' => (string)$v, // Ensure variant_id is a string
                    ];
                }
            }

            // Get variant from db
            $allVariants = ProductVariant::where('product_id', $product->id)->get(['product_id', 'variant']);
            $getSavedVariant = [];
            foreach ($allVariants as $data) {
                $getSavedVariant[] = [
                    'product_id' => $data['product_id'],
                    'variant_id' => (string)$data['variant'], // Ensure variant_id is a string
                ];
            }

            // Serialize arrays for comparison
            $serializedGetVariant = array_map('serialize', $getVariant);
            $serializedGetSavedVariant = array_map('serialize', $getSavedVariant);

            // Find differences: items in $serializedGetSavedVariant that are not in $serializedGetVariant
            $diffSerialized = array_diff($serializedGetSavedVariant, $serializedGetVariant);

            // Deserialize differences
            $arrayDiff = array_map('unserialize', $diffSerialized);
            if (isset($arrayDiff) && !empty($arrayDiff)) {
                foreach ($arrayDiff as $data) {
                    $productIds = [$data['product_id']];
                    $variantIds = [$data['variant_id']];

                    //Delete records based on product_id and variant_id
                    ProductComponent::whereIn('product_id', $productIds)->whereIn('variant_id', $variantIds)->delete();
                    ProductSpecifications::whereIn('product_id', $productIds)->whereIn('variant_id', $variantIds)->delete();
                    ProductBlog::whereIn('product_id', $productIds)->whereIn('variant_id', $variantIds)->delete();
                    ProductKeyFeatureDescription::whereIn('product_id', $productIds)->whereIn('variant_id', $variantIds)->delete();
                }
            }
        }

        if (!empty($request->variant)) {
            ProductVariant::where('product_id', $request->id)->delete();
        }
        if (!empty($request->variant)) {
            $getVariant = [];
            foreach ($request->variant as $key => $v) {
                if (!empty($v)) {
                    $getVariant[] = [
                        'product_id' => $product->id,
                        'variant_id' => $v,
                    ];
                    $insertVariant = [
                        'product_id' => $product->id,
                        'variant' => $v,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    ProductVariant::create($insertVariant);
                }
            }
        }
        if (!empty($request->specification_title)) {
            ProductOtherSpecification::where('product_id', $request->id)->delete();
        }
        if (!empty($request->specification_title)) {
            foreach ($request->specification_title as $key => $value) {
                if (!empty($value)) {
                    $insertspecf = [
                        'product_id' => $product->id,
                        'title' => isset($request->specification_title[$key]) ? $request->specification_title[$key] : '',
                        'description' => isset($request->specification_description[$key]) ? $request->specification_description[$key] : '',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    ProductOtherSpecification::create($insertspecf);
                }
            }
        }
        $validator = Validator::make($request->all(), [
            'csv_file.*' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            // Handle validation errors
        }

        try {
            if ($request->has('v_id')) {
                foreach ($request->v_id as $variantId) {
                    if ($request->hasFile("csv_file.$variantId")) {
                        $files = $request->file("csv_file.$variantId");

                        foreach ($files as $file) {
                            $path = $file->getRealPath();

                            // Read CSV file
                            $csv = Reader::createFromPath($path, 'r');
                            $csv->setHeaderOffset(0); // Assuming the CSV file has headers
                            $records = $csv->getRecords();

                            foreach ($records as $record) {
                                // Check if any cell in the row is empty
                                if (in_array('', $record, true)) {
                                    continue; // Skip this row if any cell is empty
                                }

                                // Validate the record
                                $recordValidator = Validator::make($record, [
                                    'COMPONENT' => 'required',
                                    'SPECIFICATION' => 'required',
                                    'VALUE' => 'required',
                                ]);

                                if ($recordValidator->fails()) {
                                    // Log validation errors for the specific record
                                    Log::error('CSV Record Validation Error: ' . implode(', ', $recordValidator->errors()->all()));
                                    continue; // Skip this row if validation fails
                                }

                                // Check if a record with the same component_name already exists
                                $existingRecord = ProductComponent::where('component_specification', $record['VALUE'])
                                    ->where('product_id', $product->id)->where('variant_id', $variantId)
                                    ->where('component_name', $record['SPECIFICATION'])
                                    ->where('component_type', $record['COMPONENT'])
                                    ->exists();

                                if ($existingRecord) {
                                    // Log that the record already exists
                                    Log::info('Skipping existing record: ' . $record['SPECIFICATION']);
                                    continue; // Skip this row if a similar record already exists
                                }

                                // Create ProductComponent
                                ProductComponent::create([
                                    'product_id' => $product->id,
                                    'variant_id' => $variantId, // Include the variant ID
                                    'component_type' => $record['COMPONENT'],
                                    'component_name' => $record['SPECIFICATION'],
                                    'component_specification' => $record['VALUE'],
                                ]);

                                // Log the inserted data
                                Log::info("Database Insert: " . json_encode([
                                    'product_id' => $product->id,
                                    'variant_id' => $variantId, // Include the variant ID
                                    'component_type' => $record['COMPONENT'],
                                    'component_name' => $record['SPECIFICATION'],
                                    'component_specification' => $record['VALUE'],
                                ]));
                            }
                        }
                    }
                }
            }
        } catch (Exception $e) {
            // Log the detailed error message for debugging
            Log::error('CSV Import Error: ' . $e->getMessage());
        }


        /* PDF file Upload Code */
        // Directory where the files will be stored
        $destinationPath = public_path('specesheet');

        // Create the directory if it does not exist
        if (!File::exists($destinationPath)) {
            if (!File::makeDirectory($destinationPath, 0755, true)) {
                Log::error("Failed to create directory at: " . $destinationPath);
                return back()->withErrors(['msg' => 'Failed to create directory.']);
            }
        }

        if (is_array($request->v_id)) {
            foreach ($request->v_id as $variantIndex => $variantId) {
                if (isset($request->pdf_files[$variantId])) {
                    foreach ($request->pdf_files[$variantId] as $key => $file) {
                        if ($file) {
                            $originalName = $request->pdf_names[$variantId][$key];
                            if ($originalName) {
                                try {
                                    // Move the file to the destination path
                                    $sanitizedFileName = $originalName . '.pdf';
                                    if ($file->move($destinationPath, $sanitizedFileName)) {
                                        // File moved successfully
                                        Log::info("File moved to: " . $destinationPath . '/' . $sanitizedFileName);
                                    } else {
                                        // File move failed
                                        Log::error("Failed to move file");
                                    }
                                    // Save the file information to the database
                                    $pdf = new ProductSpecifications();
                                    $pdf->value = $sanitizedFileName; // This would typically be the path to the stored file
                                    $pdf->title = 'brochures';
                                    $pdf->type = 'resource';
                                    $pdf->variant_id = $variantId; // Include the variant ID
                                    $pdf->product_id = $product->id; // Assuming $product is defined
                                    $pdf->save();
                                } catch (\Exception $e) {
                                    Log::error("Failed to upload file: " . $e->getMessage());
                                    return back()->withErrors(['msg' => 'Failed to upload file.']);
                                }
                            }
                        }
                    }
                }
            }
        }

        /* Insert and update component specification*/
        if (is_array($request->v_id)) {
            foreach ($request->v_id as $variantIndex => $variantId) {
                if (isset($request->component_type[$variantId])) {
                    foreach ($request->component_type[$variantId] as $key => $type) {
                        if (isset($request->component_id[$variantId][$key])) { // Changed $index to $key
                            $existingRecord = ProductComponent::where('product_id', $product->id)
                                ->where('variant_id', $variantId)
                                ->where('id', $request->component_id[$variantId][$key])
                                ->first();
                            if ($existingRecord) {
                                $existingRecord->component_type = $type;
                                $existingRecord->component_name = $request->component_name[$variantId][$key];
                                $existingRecord->component_specification = $request->component_specification[$variantId][$key];
                                $existingRecord->updated_at = now(); // Use Laravel's helper function for date
                                $existingRecord->save();
                            }
                        } else {
                            if (!empty($type)) {
                                $component = new ProductComponent();
                                $component->product_id = $product->id;
                                $component->variant_id = $variantId;
                                $component->component_type = $type;
                                $component->component_name = $request->component_name[$variantId][$key];
                                $component->component_specification = $request->component_specification[$variantId][$key];
                                $component->created_at = now(); // Use Laravel's helper function for date
                                $component->save();
                            }
                        }
                    }
                }
            }
        }

        /* Insert key feature description*/
        if (is_array($request->v_id)) {
            $insertArray = [];
            foreach ($request->v_id as $variantId) {
                // Check if key features are set and not empty for the current variant
                if (isset($request->key_features[$variantId]) && !empty($request->key_features[$variantId])) {
                    foreach ($request->key_features[$variantId] as $key => $type) {
                        // Check if keyfeatureid is set
                        if (isset($request->keyfeatureid) && !empty($type)) {
                            $val = true;
                            foreach ($request->keyfeatureid as $id) {
                                // Fetch existing record by keyfeatureid
                                $existingRecord = ProductKeyFeatureDescription::where('product_id', $product->id)
                                    ->where('variant_id', $variantId)
                                    ->where('id', $id)
                                    ->first();

                                // If record exists, update description
                                if ($existingRecord) {
                                    $val = false;
                                    $existingRecord->description = $type ?? null;
                                    $existingRecord->save();
                                }
                            }
                            if ($val == true) {
                                if (!empty($type)) {
                                    $insertArray[] = [
                                        'product_id' => $product->id,
                                        'variant_id' => $variantId,
                                        'description' => $type,
                                    ];
                                }
                            }
                        } else {
                            // If keyfeatureid is not set, prepare data for insertion
                            if (!empty($type)) {
                                $insertArray[] = [
                                    'product_id' => $product->id,
                                    'variant_id' => $variantId,
                                    'description' => $type,
                                ];
                            }
                        }
                    }
                }
            }

            // Insert new records
            if (!empty($insertArray)) {
                ProductKeyFeatureDescription::insert($insertArray);
            }
        }


        return redirect()->route('product.index')->with('success', "Product saved successfully.");
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $product->industries()->detach($request->industries);
        $product->product_categories()->detach($request->industries);
        $product->specifications()->delete();
        $product->videos()->delete();
        if ($product->product_images()) {
            foreach ($product->product_images() as $image) {
                unlink(public_path() . '/assets/img/product/' . $image);
            }
        }
        $product->product_images()->delete();
        $product->delete();
        return redirect()->back()->with('success', "Product Deleted successfully.");
    }
    public function destroyComponent($id)
    {
        $productComponent = ProductComponent::find($id);

        if ($productComponent) {
            $productComponent->delete();
            return redirect()->back()->with('success', "Product component deleted successfully.");
        }
    }

    public function getspecifications(Request $request)
    {

        $specifications = ProductSpecifications::select('title as value', 'title as id')->Where('title', 'like', '%' . $request->term . '%')->get();

        return response()->json($specifications);
    }

    public function destoryBrochures($id)
    {
        $deletedRows = ProductSpecifications::where('id', $id)->delete();
        return redirect()->back()->with('success', "Brochures Deleted successfully.");
    }
    public function destoryKeyFeatureSection($id)
    {
        $deletedRows = ProductBlog::where('id', $id)->delete();
        return redirect()->back()->with('success', "Key Feature Section Deleted successfully.");
    }
    public function fetchData(Request $request)
    {
        // Retrieve the product and variant IDs from the request
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $data = ProductComponent::Where('product_id', $productId)->Where('variant_id', $variantId)->get();
        // Return the fetched data as a response (e.g., HTML view)
        return response()->json($data);
    }
    public function fetchKeyFeatureSectionData(Request $request)
    {
        // Retrieve the product and variant IDs from the request
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $data = ProductBlog::Where('product_id', $productId)->Where('variant_id', $variantId)->get();
        // Return the fetched data as a response (e.g., HTML view)
        return response()->json($data);
    }
    public function fetchBrochuresData(Request $request)
    {
        // Retrieve the product and variant IDs from the request
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $data = ProductSpecifications::Where('product_id', $productId)->Where('variant_id', $variantId)->Where('type', 'resource')->Where('title', 'brochures')->get();
        // Return the fetched data as a response (e.g., HTML view)
        return response()->json($data);
    }
    public function fetchKeyFeatureDescData(Request $request)
    {
        // Retrieve the product and variant IDs from the request
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $data = ProductKeyFeatureDescription::Where('product_id', $productId)->Where('variant_id', $variantId)->get();
        // Return the fetched data as a response (e.g., HTML view)
        return response()->json($data);
    }
    public function delete($id)
    {
        try {
            // Find the product by ID
            $product = Product::find($id);

            // Check if product exists
            if (!$product) {
                return response()->json(['error' => 'Product not found.'], 404);
            }

            // Attempt to delete related records
            $productComponents = ProductComponent::where('product_id', $id);
            $productBlogs = ProductBlog::where('product_id', $id);
            $productSpecifications = ProductSpecifications::where('product_id', $id);
            $productKeyFeatureDescriptions = ProductKeyFeatureDescription::where('product_id', $id);
            $productVariants = ProductVariant::where('product_id', $id);

            // Start a transaction to ensure all deletes succeed or none
            DB::beginTransaction();

            $productComponents->delete();
            $productBlogs->delete();
            $productSpecifications->delete();
            $productKeyFeatureDescriptions->delete();
            $productVariants->delete();
            $product->delete();

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Product and related data deleted successfully.']);
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            // Return an error response
            return response()->json(['error' => 'Failed to delete product. ' . $e->getMessage()], 500);
        }
    }
}
