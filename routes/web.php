<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

//index Routes
Route::get('/', 'HomeController@index')->name('web.home');
//successStory Routes
Route::get('/success-stories', 'HomeController@successStory')->name('success-stories');
//successStoryDetail Routes
Route::get('/success-story-details/{slug}','HomeController@successStoryDetail')->name('success-story-details');
//newsRoom Routes
Route::get('/news-and-blogs', 'HomeController@newsRoom')->name('news-and-blogs');
//newsRoomDetail Routes
Route::get('/newsRoomDetail/{slug}','HomeController@newsRoomDetail')->name('newsRoomDetail');
//productDetail Routes
Route::get('/product/{slug}','HomeController@productDetail')->name('product');
//industryDetail Routes
Route::get('/industry/{slug}','HomeController@industryDetail')->name('industry');
//aboutus Routes
Route::get('/aboutus','HomeController@aboutus')->name('aboutus');
//displaysolutions Routes
Route::get('/displaysolutions/{slug}','HomeController@displaysolutions')->name('displaysolutions');
//casestudy Routes
Route::get('/case-study', 'HomeController@casestudy')->name('case-study');
//casestudydetails Routes
Route::get('/case-study-details/{slug}', 'HomeController@casestudydetails')->name('case-study-details');

//privacy policy Routes
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');

//terms and conditions Routes
Route::get('/terms-and-conditions', 'HomeController@terms')->name('terms-and-conditions');

//displaysolutions policy Routes
Route::get('/displaysolutions', [HomeController::class, 'displaysolutions']);

//inquire-now Routes
Route::get('/inquire-now', 'HomeController@inquireNow')->name('inquire-now');
Route::post('postInquiry','HomeController@postInquiry')->name('postInquiry');
Route::get('/thankyou','HomeController@thankyou')->name('thankyou');
Route::get('/search','HomeController@search')->name('search');
Route::get('/fetchProductDetails', 'HomeController@fetchProductDetails')->name('fetchProductDetails');
Route::post('aboutusPostInquiry','HomeController@aboutusPostInquiry')->name('aboutusPostInquiry');
Route::get('/getProductList', 'HomeController@getProductList')->name('getProductList');
Route::get('/getProductListFilterParticularPage', 'HomeController@getProductListFilterParticularPage')->name('getProductListFilterParticularPage');
Route::post('/get-industries-for-products', 'HomeController@getIndustriesForProducts')->name('get-industries-for-products');

/* Admin Routes */
Route::prefix('admin')->middleware([])->group(function() { 
    Auth::routes();
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
    Route::namespace('Admin')->middleware(['auth'])->group(function() {
        Route::get('/change-password', 'HomeController@changepassword')->name('password.change');
        Route::post('/change-password', 'HomeController@changePasswordSubmit')->name('password.change.submit');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/', 'HomeController@index')->name('home');        
        Route::get('/imageuploader', 'Imageuploader@upload')->name('imageuploader');
        Route::post('/imageuploader/upload', 'Imageuploader@imagesupload')->name('imageuploader.imagesupload');
        //Page Routes
        Route::resource('page','PagesController');

        Route::get('product/getspecifications','ProductController@getspecifications')->name('product.getspecifications');
        //Products Routes
        Route::resource('product','ProductController');
        //Categories Routes
        Route::resource('productCategory','ProductCategoriesController');
        Route::resource('productVariantList','ProductVariantListController');
        Route::post('product/export','ProductController@export')->name('product.export');
        Route::get('newsroom/banner','NewsroomController@banner')->name('newsroom.banner');
        Route::post('newsroom/banner/store','NewsroomController@bannerstore')->name('newsroom.banner.store');
        Route::resource('newsroom','NewsroomController');
        Route::get('contact-us/settings','ContactusController@settings')->name('contact.settings');
        Route::post('contact-us/settings','ContactusController@store')->name('contact.store');
        Route::get('contact-us/list','ContactusController@list')->name('contact.list');
        Route::get('contact/export','ContactusController@export')->name('contact.export');
        Route::get('home/image-slider','HomeController@imageSlider')->name('home.image.slider');
        Route::post('home/image-slider','HomeController@imageSliderSave')->name('home.image.slider.save');
        Route::delete('home/image-slider/{id}','HomeController@imageSliderDelete')->name('home.image.slider.delete');
        Route::post('home/image-slider/order','HomeController@sliderOrder')->name('home.image.slider.order');
        Route::get('home/video-slider','HomeController@videoSlider')->name('home.video.slider');
        Route::post('home/video-slider','HomeController@videoSliderSave')->name('home.video.slider.save');
        
        Route::get('footer/sociallinks','HomeController@sociallinks')->name('admin.footer.sociallinks');
        Route::post('footer/sociallinks','HomeController@sociallinksSave')->name('admin.footer.sociallinks.save');
        Route::get('footer/copyright','HomeController@copyright')->name('admin.footer.copyright');
        Route::post('footer/copyright','HomeController@copyrightSave')->name('admin.footer.copyright.save');

        Route::get('header/menu','HomeController@headermenu')->name('admin.header.menu');
        Route::get('header/menu/{id}/edit','HomeController@headermenucreate')->name('admin.header.menu.edit');
        Route::get('header/menu/create','HomeController@headermenucreate')->name('admin.header.menu.create');
        Route::delete('headermenu/delete/{id}','HomeController@headermenudelete')->name('admin.header.menu.delete');
        Route::post('header/menu/save','HomeController@menuSave')->name('admin.header.menu.save');
    
        Route::get('footer/menu','HomeController@footermenu')->name('admin.footer.menu');
        Route::post('footer/menu/save','HomeController@menuSave')->name('admin.footer.menu.save');

        Route::resource('casestudy','CasestudyController');

        Route::resource('successstory','SuccessStoryController');
        Route::resource('newsroom','NewsroomController');
        Route::resource('industry','IndustryController');
        Route::resource('displaysolution','DisplaySolutionController');
        Route::resource('slider','SliderController');
        Route::resource('content','ContentController');
        Route::resource('industryBlog','IndustryBlogController');
        Route::resource('professionalDisplay','ProfessionalDisplayController');
        Route::resource('video','VideoController');
        Route::resource('videoLink','VideoLinkController');
        Route::resource('sliderList','SliderListController');
        Route::get('sliderList/{type}', 'SliderListController@index')->name('sliderList');
        // Define the route with the 'contentList' name
        Route::resource('contentList','ContentListController');
        Route::get('contentList', 'ContentListController@index')->name('contentList');

        Route::delete('/product/destoryBrochures/{id}', [ProductController::class, 'destoryBrochures'])->name('product.destoryBrochures');
        // Define resource routes for productSeries
        Route::resource('productSeries', ProductSeriesController::class);
        Route::get('/fetchData', 'ProductController@fetchData')->name('fetchData');
        Route::get('/fetchKeyFeatureSectionData', 'ProductController@fetchKeyFeatureSectionData')->name('fetchKeyFeatureSectionData');
        Route::get('/fetchBrochuresData', 'ProductController@fetchBrochuresData')->name('fetchBrochuresData');
        Route::get('/fetchKeyFeatureDescData', 'ProductController@fetchKeyFeatureDescData')->name('fetchKeyFeatureDescData');
        Route::delete('/product/destroyComponent/{id}', [ProductController::class, 'destroyComponent'])->name('product.destroyComponent');
        Route::delete('/product/destoryKeyFeatureSection/{id}', [ProductController::class, 'destoryKeyFeatureSection'])->name('product.destoryKeyFeatureSection');
        Route::get('index', 'ProductController@index')->name('index');
        Route::delete('/products/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        Route::get('/products/{id}/edit', 'ProductController@edit')->name('product.edit');
        Route::get('social-links', 'ContactusController@sociallinks')->name('sociallinks');
        Route::post('social-links', 'ContactusController@storeSocialLinks')->name('contact.storeSocialLinks');

    });
});
/* This route used to clear cache */
Route::get('/cache/clear',  function() {
     $exitCode = Artisan::call('config:cache');
     return 'Config cache cleared';
 });

