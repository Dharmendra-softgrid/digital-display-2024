<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pages;
use App\ProductCategory;
use App\ProductCategoryMap;
use App\ProductIndustryMap;
use App\Product;
use App\ProductSpecifications;
use App\Newsroom;
use App\Industries;
use App\Settings;
use App\Contacts;
use App\Slider;
use App\Content;
use App\SuccessStories;
use App\DisplaySolution;
use App\ProductImages;
use App\ProductVideos;
use App\ProductBlog;
use App\IndustryImages;
use App\IndustryBlog;
use App\Menu;
use App\Casestudy;
use App\ProfessionalDisplaySolution;
use App\ProductVariant;
use App\ProductOtherSpecification;
use App\Video;
use App\VideoLink;
use App\InquireNow;
use App\IndustryDetail;
use App\SolutionDetail;
use App\ProductComponent;
use Illuminate\Support\Facades\Log;


use Validator;
use DB;
use App\ProductKeyFeatureDescription;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function __construct()
    {
        // Set a global variable in the constructor
        /* This code gets all menu listed in menu table in the form of array */
        $this->menus =  Menu::with('children')->orderBy('sort_order', 'ASC')->where('parent', 0)->get();
        $this->industries = Industries::get();
        $this->profDisplaySolution = DisplaySolution::join('professional_display_solution', 'display_solution.id', '=', 'professional_display_solution.solution_id')
            ->select('professional_display_solution.*', 'display_solution.title as solution_title', 'display_solution.slug as solution_slug')
            ->orderBy('professional_display_solution.id', 'asc')->get();
        $this->settings_email = Settings::where('type', 'contact')->where('skey', 'email')->first();
        $this->settings_mobile = Settings::where('type', 'contact')->where('skey', 'mobile')->first();
        $this->settings_address = Settings::where('type', 'contact')->where('skey', 'address')->first();

        $this->settings_facebook = Settings::where('type', 'sociallinks')->where('skey', 'facebook')->first();
        $this->settings_instagram = Settings::where('type', 'sociallinks')->where('skey', 'instagram')->first();
        $this->settings_linkedin = Settings::where('type', 'sociallinks')->where('skey', 'linkedin')->first();
        $this->settings_twitter = Settings::where('type', 'sociallinks')->where('skey', 'twitter')->first();
        $this->settings_youtube = Settings::where('type', 'sociallinks')->where('skey', 'youtube')->first();
    }
    /* main function */
    public function index(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['successstories'] = SuccessStories::orderBy('id', 'DESC')->paginate(15);
        $data['newsrooms'] = Newsroom::orderBy('id', 'DESC')->paginate(4);
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'ASC')->paginate(15);
        $data['products'] = Product::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'HOME')->paginate(15);
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_sec_content')->where('page', 'home')->first();
        $data['second_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'second_sec_content')->where('page', 'home')->first();
        $data['third_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'third_sec_content')->where('page', 'home')->first();
        $data['fourth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fourth_sec_content')->where('page', 'home')->first();
        $data['fifth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fifth_sec_content')->where('page', 'home')->first();
        $data['sixth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'sixth_sec_content')->where('page', 'home')->first();
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['videos'] = Video::orderBy('id', 'DESC')->where('type', 'HOME')->paginate(15);
        // $getData = Content::All();
        // echo '<pre>';
        // Retrieve the first record
        $data['homeDisplaySolution'] = DisplaySolution::orderBy('sort_order', 'ASC')->where('display_at_homepage', '1')->paginate(15);

        $data['videoLink'] = VideoLink::orderBy('sort_order', 'Asc')->where('type', 'HOME')->paginate(15);
        $data['firstVideoLink'] = VideoLink::orderBy('sort_order', 'Asc')->where('type', 'HOME')->first();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;

        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('home', $data);
    }

    public function successStory(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['successstories'] = SuccessStories::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'success-stories')->paginate(15);
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['videoLink'] = VideoLink::orderBy('sort_order', 'Asc')->where('type', 'HOME')->paginate(15);
        $data['firstVideoLink'] = VideoLink::orderBy('sort_order', 'Asc')->where('type', 'HOME')->first();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('successstory', $data);
    }

    public function successStoryDetail(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        //var_dump($slug);
        //$data['successstories'] = SuccessStories::orderBy('id', 'DESC')->paginate(15);
        $data['successstory'] = SuccessStories::where('slug', $slug)->first();
        //dd([$data['successstory']->toSql(),$data['successstory']->getBindings()]);
        $sliders = SuccessStories::where('slug', $slug)->first()->banner_section;
        $data['sliders'] = json_decode($sliders);
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['products'] = Product::inRandomOrder()->paginate(4);
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('successstorydetail', $data);
    }

    public function newsRoom(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['newsrooms'] = Newsroom::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'news-and-blogs')->paginate(15);
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('newsroom', $data);
    }

    public function newsRoomDetail(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        //var_dump($slug);
        //$data['successstories'] = SuccessStories::orderBy('id', 'DESC')->paginate(15);
        $data['newsrooms'] = Newsroom::inRandomOrder()->take(3)->get();
        $data['newsrooms'] = new \Illuminate\Pagination\LengthAwarePaginator($data['newsrooms'], count($data['newsrooms']), 15);
        $newsroom = Newsroom::where('slug', $slug)->first();
        $data['newsroom'] = isset($newsroom) ? $newsroom : '';
        // get previous user id
        $data['previous'] = Newsroom::where('id', '<', $newsroom->id)->orderBy('id', 'desc')->first();
        // get next user id
        $data['next'] = Newsroom::where('id', '>', $newsroom->id)->orderBy('id', 'asc')->first();
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        //dd([$data['successstory']->toSql(),$data['successstory']->getBindings()]);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'NEWS_ROOM')->paginate(15);
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('newsroomdetail', $data);
    }

    public function productDetail(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $product = Product::where('slug', $slug)->first();
        $data['product'] = isset($product) ? $product : '';
        $data['productImages'] = ProductImages::orderBy('id', 'DESC')->where('product_id', $product->id)->get();
        $data['productBrochures'] = ProductSpecifications::where('title', 'brochures')->where('product_id', $product->id)->get();
        $productCategoryIdArr = ProductCategoryMap::where('product_id', $product->id)->groupBy('product_category_id')->pluck('product_category_id')->toArray();
        $data['relatedProducts'] = Product::where('series', $product->series)->where('id', '!=', $product->id)->inRandomOrder()->paginate(4);
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['productBlog'] = ProductBlog::orderBy('id', 'DESC')->where('product_id', $product->id)->get();
        $data['productVariant'] = ProductVariant::where('product_id', $product->id)
        ->join('variant_list', 'product_variant.variant', '=', 'variant_list.id')
        ->orderByRaw('CAST(variant_list.name AS UNSIGNED) ASC') // Sort by numeric value of `name`
        ->orderBy('product_variant.id', 'DESC') // Secondary sort by `id`
        ->select('product_variant.*') // Ensure only product_variant fields are selected
        ->get();
        //ProductVariant::orderBy('id', 'DESC')->where('product_id', $product->id)->get();
        $data['productSpecification'] = ProductSpecifications::orderBy('id', 'DESC')->where('product_id', $product->id)->where('type', 'specification')->get();
        $productComponents = ProductComponent::orderBy('id', 'ASC')
            ->where('product_id', $product->id)
            ->get()
            ->groupBy('component_type');

        $data['productComponents'] = $productComponents;
        $data['ProductOtherSpecification'] = ProductOtherSpecification::orderBy('id', 'DESC')->where('product_id', $product->id)->get();
        //dd([$data['successstory']->toSql(),$data['successstory']->getBindings()]);   
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('productdetail', $data);
    }

    public function industryDetail(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $industry = Industries::where('slug', $slug)->first();
        $data['industry'] = isset($industry) ? $industry : '';
        $sliders = Industries::where('slug', $slug)->first()->banner_section;
        $data['sliders'] = json_decode($sliders);
        $data['galleryImages'] = IndustryImages::orderBy('id', 'DESC')->where('industry_id', $industry->id)->get();
        //$data['productBrochures'] = ProductSpecifications::where('title', 'brochures')->where('product_id', $product->id)->get();
        $productIdArr = ProductIndustryMap::where('industry_id', $industry->id)->groupBy('product_id')->pluck('product_id')->toArray();
        //$productIdArr = ProductCategoryMap::whereIn('product_category_id', $productCategoryIdArr)->where('product_id','!=', $product->id)->pluck('product_id')->toArray();
        $data['relatedProducts'] = Product::whereIn('id', $productIdArr)->get();
        $data['industries'] = Industries::orderBy('id', 'ASC')->get();
        //dd([$data['successstory']->toSql(),$data['successstory']->getBindings()]);   
        $data['industryDetail'] = IndustryDetail::orderBy('id', 'ASC')->where('industries_id', $industry->id)->get();
        $data['IndustryBlog'] = IndustryBlog::orderBy('id', 'DESC')->where('industry_id', $industry->id)->get();
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('industrydetail', $data);
    }
    public function aboutus(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_sec_content')->where('page', 'about-us')->first();
        $data['second_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'second_sec_content')->where('page', 'about-us')->first();
        $data['videoLink'] = VideoLink::orderBy('sort_order', 'Asc')->where('type', 'ABOUTUS')->first();
        $data['third_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'third_sec_content')->where('page', 'about-us')->first();
        $data['fourth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fourth_sec_content')->where('page', 'about-us')->first();
        $data['fifth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fifth_sec_content')->where('page', 'about-us')->first();
        $data['sixth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'sixth_sec_content')->where('page', 'about-us')->first();
        $data['seventh_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'seventh_sec_content')->where('page', 'about-us')->first();
        $data['eighth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'eighth_sec_content')->where('page', 'about-us')->first();
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'aboutus')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('aboutus', $data);
    }
    public function displaysolutions(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';

        $displaysolutions = DisplaySolution::where('slug', $slug)->first();
        // echo "<pre>";print_r($displaysolutions);die;
        $data['displaysolutions'] = $displaysolutions;
        $data['solutions'] = DisplaySolution::orderBy('id', 'ASC')->get();
        $data['solutionDetail'] = SolutionDetail::orderBy('id', 'ASC')->where('display_solution_id', $displaysolutions->id)->get();
        $menuData = Menu::where('page', $displaysolutions->id)->first();
        $data['parentBredcrumName'] = Menu::where('id', $menuData['parent'])->first();
        $data['industries'] = Industries::paginate(10); // Adjust per page as needed
        $sliders = DisplaySolution::where('slug', $slug)->first()->banner_section;
        $data['sliders'] = json_decode($sliders);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['products'] = Product::inRandomOrder()->paginate(10);
        $data['totalProducts'] = $data['products']->total();
        // Get the total count
        $data['totalProductCount'] = Product::count();
        $data['signageotherbanner'] = Content::orderBy('id', 'DESC')->where('page', 'Signage Enterprise')->first();
        $data['slug'] = $slug;
        //$data['products'] = new \Illuminate\Pagination\LengthAwarePaginator($data['product'], count($data['product']), 15);
        $data['homeDisplaySolution'] = DisplaySolution::orderBy('sort_order', 'ASC')->where('display_at_homepage', '1')->paginate(15);
        $getMenuId = DisplaySolution::where('id', $displaysolutions->id)->value('menu_id');
        $data['getRelatedSolutions'] = Menu::whereIn('parent', [$getMenuId])
            ->join('display_solution', 'menu.id', '=', 'display_solution.menu_id')
            ->where('display_solution.at_solutions', '=', 1)
            ->distinct()
            ->orderBy('display_solution.order_display', 'ASC')
            ->get();
        $data['getAllSolutions'] = Menu::select('menu.id', 'menu.title')
            ->whereIn('parent', [$getMenuId])
            ->join('display_solution', 'menu.id', '=', 'display_solution.menu_id')
            ->distinct()
            ->orderBy('display_solution.order_display', 'ASC')
            ->get();
        $grid_section = DisplaySolution::where('slug', $slug)->first()->grid_section;
        $data['grid_section'] = json_decode($grid_section);
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('displaysolutions', $data);
    }

    public function getIndustriesForProducts(Request $request){
      
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer|exists:products,id'
        ]);
        $productIds = $request->input('product_ids');
        // dd($productIds);
        $industries = Industries::whereIn('id', function($query) use ($productIds) {
            $query->select('industry_id')
                  ->from('product_industry_map')
                  ->whereIn('product_id', $productIds);
        })->get();
    
        return response()->json([
            'industries' => $industries
        ]);
    }
    public function casestudy(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'CASESTUDY')->first();
        $data['casestudies'] = Casestudy::orderBy('id', 'DESC')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('casestudy', $data);
    }
    public function casestudydetails(Request $request, $slug)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = Industries::orderBy('id', 'DESC')->paginate(6);
        $data['displaysolutions'] = isset($this->industries) ? $this->industries : '';
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'CASESTUDYDETAILS')->first();
        $data['casestudies'] = Casestudy::orderBy('id', 'DESC')->paginate(15);
        $data['casestudiesdetails'] = Casestudy::where('slug', $slug)->first();
        $data['product'] = Product::inRandomOrder()->take(4)->get();
        $data['products'] = new \Illuminate\Pagination\LengthAwarePaginator($data['product'], count($data['product']), 15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('casestudydetails', $data);
    }
    public function privacyPolicy(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'privacy-policy')->first();
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_sec_content')->where('page', 'privacy-policy')->first();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('privacypolicy', $data);
    }
    public function terms(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['slider'] = Slider::orderBy('id', 'DESC')->where('type', 'terms-and-conditions')->first();
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_sec_content')->where('page', 'tearms-and-conditions')->first();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('terms', $data);
    }
    public function inquireNow(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_section')->where('page', 'inquire-now')->first();
        $data['second_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'second_section')->where('page', 'inquire-now')->first();
        $data['third_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'third__section')->where('page', 'inquire-now')->first();
        $data['fourth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fourth_section')->where('page', 'inquire-now')->first();
        $data['fifth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fifth_section')->where('page', 'inquire-now')->first();
        $data['sixth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'sixth_section')->where('page', 'inquire-now')->first();
        $data['seventh_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'seventh_section')->where('page', 'inquire-now')->first();
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'inquire-now')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['industries'] = Industries::with('IndustryBlog')->get();
        $data['products'] = Product::orderBy('id', 'DESC')->get();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_sec_content')->where('page', 'inquire-now')->first();
        $data['second_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'second_sec_content')->where('page', 'inquire-now')->first();
        return view('inquirenow', $data);
    }
    public function postInquiry(Request $request)
    {
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        // Validation rules for the request
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'company' => 'required|max:255',
            'interested_category' => 'required|max:255',
            'interested_subcategory' => 'required|max:255',
            'product' => 'required',
        ];
        $inquireNow = new InquireNow();
        $inquireNow->first_name = $request->first_name;
        $inquireNow->last_name = $request->last_name;
        $inquireNow->email = $request->email;
        $inquireNow->phone = $request->phone;
        $inquireNow->state = $request->state;
        $inquireNow->city = $request->city;
        $inquireNow->company = $request->company;
        $inquireNow->interested_category = $request->interested_category;
        $inquireNow->interested_subcategory = $request->interested_subcategory;
        $inquireNow->product = $request->product;
        // Save the inquiry to the database   
        $inquireNow->save();
        return redirect()->route('thankyou')->with('success', "Enquiry Submitted successfully.");
    }
    public function thankyou(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['first_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'first_section')->where('page', 'thankyou')->first();
        $data['second_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'second_section')->where('page', 'thankyou')->first();
        $data['third_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'third__section')->where('page', 'thankyou')->first();
        $data['fourth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fourth_section')->where('page', 'thankyou')->first();
        $data['fifth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'fifth_section')->where('page', 'thankyou')->first();
        $data['sixth_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'sixth_section')->where('page', 'thankyou')->first();
        $data['seventh_sec_content'] = Content::orderBy('id', 'DESC')->where('section_type', 'seventh_section')->where('page', 'thankyou')->first();
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'thankyou')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['industries'] = Industries::with('IndustryBlog')->get();
        $data['products'] = Product::orderBy('id', 'DESC')->get();
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('thankyou', $data);
    }
    public function search(Request $request)
    {
        $data['menus'] = isset($this->menus) ? $this->menus : '';
        $data['industries'] = isset($this->industries) ? $this->industries : '';
        $data['displaysolutions'] = DisplaySolution::orderBy('id', 'DESC')->paginate(15);
        $data['sliders'] = Slider::orderBy('id', 'DESC')->where('type', 'search')->paginate(15);
        $data['pfd'] = isset($this->profDisplaySolution) ? $this->profDisplaySolution : '';
        $data['industries'] = Industries::with('IndustryBlog')->get();
        $data['products'] = Product::orderBy('id', 'DESC')->get();
        $query = $request->input('query');

        // Perform search on each model
        $products = Product::where('title', 'like', "%$query%")->orWhere('short_description', 'like', "%$query%")->orWhere('key_features', 'like', "%$query%")->get();
        $news = Newsroom::where('title', 'like', "%$query%")->get();
        $about = Content::where('page', 'ABOUT')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%$query%")
                    ->orWhere('content', 'like', "%$query%");
            })
            ->get();
        $successStories = SuccessStories::where('title', 'like', "%$query%")->orWhere('content', 'like', "%$query%")->get();
        $industries = Industries::where('title', 'like', "%$query%")->orWhere('content', 'like', "%$query%")->get();
        $home = Content::where('page', 'HOME')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%$query%")
                    ->orWhere('content', 'like', "%$query%");
            })
            ->get();
        // Aggregate the search results
        $data['searchData'] = collect([
            'products' => $products,
            'news' => $news,
            'about' => $about,
            'successStories' => $successStories,
            'industries' => $industries,
            'home' => $home,
        ]);
        $data['input'] = $query;
        $data['settings_email'] = $this->settings_email;
        $data['settings_mobile'] = $this->settings_mobile;
        $data['settings_address'] = $this->settings_address;
        $data['settings_facebook'] = $this->settings_facebook;
        $data['settings_instagram'] = $this->settings_instagram;
        $data['settings_linkedin'] = $this->settings_linkedin;
        $data['settings_twitter'] = $this->settings_twitter;
        $data['settings_youtube'] = $this->settings_youtube;
        return view('searchResult', $data);
    }
    public function fetchProductDetails(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');

        $broschures = ProductSpecifications::where('product_id', $productId)->where('variant_id', $variantId)->get();
        $data['broschures'] = $broschures ?? 0;
        $productComponents = ProductComponent::orderBy('id', 'ASC')
            ->where('product_id', $productId)->where('variant_id', $variantId)
            ->get()
            ->groupBy('component_type');
        $data['productComponents'] = $productComponents ?? 0;
        //$productKeyFeatureDescription = ProductKeyFeatureDescription::where('product_id', $productId)->where('variant_id', $variantId)->get();
        $productKeyFeatureDescription = Product::select('key_features')->where('id',$productId)->first();

        $data['productKeyFeatureDescription'] =$productKeyFeatureDescription ?? 0;
        $productKeyFeature = ProductBlog::where('product_id', $productId)->where('variant_id', $variantId)->get();
        $data['productKeyFeature'] = $productKeyFeature ?? 0;
        // Return the fetched data as a JSON response
        return response()->json($data);
    }
    public function aboutusPostInquiry(Request $request)
    {
        $messages = array(
            //'images.required' => 'Atleast 1 image required',
        );
        // Validation rules for the request
        $rules = [
            'first_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
        ];
        $inquireNow = new InquireNow();
        $inquireNow->first_name = $request->first_name;
        $inquireNow->email = $request->email;
        $inquireNow->phone = $request->phone;
        $inquireNow->save();
        return redirect()->route('thankyou')->with('success', "Enquiry Submitted successfully.");
    }
    public function getProductList(Request $request)
    {
        $query = Product::query();

        // Filter products based on selected industries
        if ($request->filled('industries')) {
            $industries = $request->input('industries');
            $productIds = ProductIndustryMap::whereIn('industry_id', $industries)->pluck('product_id');
            $query->whereIn('id', $productIds);
        }

        // Handle solutionTitle if present
        if ($request->filled('solutionTitle')) {
            $solutionTitle = $request->input('solutionTitle');

            // Fetch menu IDs in one query
            $menuIds = DB::table('menu')->where('slug', 'LIKE', $solutionTitle)->value('id');
            if (!empty($menuIds)) {
                // Fetch related solutions in one query with the required order
                $relatedSolutions = DB::table('menu')
                    ->select('menu.id')
                    ->join('display_solution', 'menu.id', '=', 'display_solution.menu_id')
                    ->where('menu.parent', $menuIds)
                    ->orderBy('display_solution.order_display', 'ASC')
                    ->pluck('menu.id');
                if ($relatedSolutions->isNotEmpty()) {
                    $query->whereIn('series', $relatedSolutions);
                }
            }
        }

        if ($request->filled('series')) {
            $series = $request->input('series');
            $query->whereIn('series', $series);
        }

        // Paginate and return products
        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($products);
    }
    public function getProductListFilterParticularPage(Request $request)
    {
        $query = Product::query();
        $solutionTitle = $request->input('solutionTitle');
        $menuIds = DB::table('menu')->where('slug', 'LIKE', $solutionTitle)->value('id');
        $query->where('series', $menuIds);
        // Filter products based on selected industries
        if ($request->filled('industries')) {
            $industries = $request->input('industries');
            $productIds = ProductIndustryMap::whereIn('industry_id', $industries)->pluck('product_id');
            $query->whereIn('id', $productIds);
        }

        // Handle solutionTitle if present

        if ($request->filled('series')) {
            $series = $request->input('series');
            $query->whereIn('series', $series);
        }

        // Paginate and return products
        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($products);
    }
}
