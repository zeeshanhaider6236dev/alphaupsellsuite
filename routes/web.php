<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.shopify'])->group(function(){
    Route::get('/','WelcomeController@index')->name('home')->middleware(['CustomBillable','FirstTimeRedirect']);
    Route::get('/create/upsell/{upsellType}','WelcomeController@createUpsell')->name('create.upsell')->middleware('skip.upsell');
    Route::get('/search/{tabType}/{cursor?}/{type?}','WelcomeController@search')->name('search');
    Route::post('/store/upsell/{upsellType}','WelcomeController@storeUpsell')->name('upsell.store');
    Route::get('/edit/upsell/{upsell}','WelcomeController@editUpsell')->name('upsell.edit');
    Route::get('/storefront/view/upsell/{upsell}','WelcomeController@storeFrontViewUpsell')->name('upsell.storefrontview');
    Route::post('/update/upsell/{upsell}','WelcomeController@updateUpsell')->name('upsell.update');
    Route::post('/updateStatus','WelcomeController@updateStatus')->name('upsell.updateStatus');
    Route::post('/deleteUpsell','WelcomeController@deleteUpsell')->name('upsell.delete');
    Route::post('/setPriority','WelcomeController@setPriority')->name('upsell.setPriority');
    Route::get('plans','WelcomeController@plans')->name('plans');
    Route::post('/contact','ContactUsController@store')->name('contact');
});

Route::middleware('cors')->group(function(){
    Route::post('/getData','WelcomeController@getData')->name('upsell.getData');
    Route::post('/getPostPurchaseData','WelcomeController@getPostPurchaseData')->name('postpurchase.getData');
    Route::post('/getIncartData','WelcomeController@getIncartData')->name('incart.getData');
    // Route::get('/trackUpsell','WelcomeController@trackUpsell')->name('upsell.track');
    Route::post('/create/discounts','DiscountController@createDiscounts')->name('discounts.create');
    Route::post('/count/view','WelcomeController@countView')->name('count.view');
    Route::get('/checkout','CheckoutController@alpha_post_purchase');
    Route::get('/sign-changeset','CheckoutController@jwt_token_varify');
});

Route::get('/login',function(){
    return view('login');
})->name('login');
// Billing page route
Route::view('/pricing','pricing');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::post('test','WelcomeController@test')->name('test');

Route::get('clear',function(){
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    return 'cache cleared.';
});

// Route::get('migrate',function(){
//     Artisan::call('migrate:fresh');
//     Artisan::call('db:seed');
//     return "migration completed.";
// });


Route::middleware(['auth.proxy','cors'])->group(function(){
    Route::post('/proxy','ProxyController@getData');
    Route::post('/proxy/getPostPurchaseData','ProxyController@getPostPurchaseData');
    Route::post('/proxy/getIncartData','ProxyController@getIncartData');
    Route::get('/proxy/trackUpsell','WelcomeController@trackUpsell')->name('upsell.track');
    Route::post('/proxy/count/view','WelcomeController@countView')->name('count.view');
    Route::post('/proxy/create/discounts','DiscountController@createDiscounts')->name('discounts.create');
});

