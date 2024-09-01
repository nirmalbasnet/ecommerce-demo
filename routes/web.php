<?php

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

Route::group(['middleware' => 'web', 'namespace' => 'Frontend'], function (){
    Route::get('/', 'HomeController@index');
    Route::get('category/{slug}', 'CategoryController@index');
    Route::get('category/{slug}/autocomplete', 'CategoryController@autocomplete');
    Route::match(['get', 'post'], 'category/{catslug}/{proslug}', 'CategoryController@product');
    Route::get('about-us', 'AboutController@index');
    Route::get('terms-&-conditions', 'TermsController@index');
    Route::match(['get', 'post'], 'contact-us', 'ContactController@index');
    Route::get('login', 'UserController@login');
    Route::get('logout', 'UserController@logout');
    Route::post('login/validation', 'UserController@loginValidation');
    Route::match(['get', 'post'],'sign-up', 'UserController@signUp');
    Route::get('user/email/activation', 'UserController@activation');
    Route::match(['get', 'post'], 'lost-password', 'UserController@lostPassword');
    Route::match(['get', 'post'], 'lost-password/reset', 'UserController@resetPassword');

    Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function (){
        Route::get('/', 'ProfileController@profile');
        Route::post('{id}/update', 'ProfileController@updateProfile');
        Route::post('{id}/change-password', 'ProfileController@changePassword');
    });


    Route::get('subscribe-newsletter', 'NewsLetterController@subscribe');
    Route::get('subscribe-newsletter/verify', 'NewsLetterController@verifySubscribe');
});


//Routes for admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    Route::get('/', 'LoginController@login');
    Route::post('login/validate', 'LoginController@loginValidate');
    Route::group(['middleware' => 'admin'], function (){
        Route::get('dashboard', 'DashboardController@dashboard');

        Route::group(['prefix' => 'home-banner'], function(){
           Route::get('/', 'HomeBannerController@index');
           Route::get('create', 'HomeBannerController@create');
           Route::post('submit', 'HomeBannerController@submit');
           Route::get('{id}/status', 'HomeBannerController@status');
           Route::get('{id}/delete', 'HomeBannerController@delete');
        });

        Route::group(['prefix' => 'product-category'], function (){
            Route::get('/', 'ProductCategoryController@index');
            Route::get('create', 'ProductCategoryController@create');
            Route::post('submit', 'ProductCategoryController@submit');
            Route::get('{id}/status', 'ProductCategoryController@status');
            Route::get('{id}/delete', 'ProductCategoryController@delete');
            Route::get('{id}/edit', 'ProductCategoryController@edit');
            Route::post('{id}/update', 'ProductCategoryController@update');
        });

        Route::group(['prefix' => 'product'], function (){
            Route::get('/', 'ProductController@index');
            Route::get('create', 'ProductController@create');
            Route::post('submit', 'ProductController@submit');
            Route::get('{id}/status', 'ProductController@status');
            Route::get('{id}/delete', 'ProductController@delete');
            Route::get('{id}/edit', 'ProductController@edit');
            Route::post('{id}/update', 'ProductController@update');
        });

        Route::group(['prefix' => 'testimony'], function (){
            Route::get('/', 'TestimonyController@index');
            Route::get('create', 'TestimonyController@create');
            Route::post('submit', 'TestimonyController@submit');
            Route::get('{id}/status', 'TestimonyController@status');
            Route::get('{id}/delete', 'TestimonyController@delete');
            Route::get('{id}/edit', 'TestimonyController@edit');
            Route::post('{id}/update', 'TestimonyController@update');
        });

        Route::group(['prefix' => 'contact-details'], function (){
            Route::get('/', 'ContactDetailController@index');
            Route::post('submit', 'ContactDetailController@submit');
        });

        Route::group(['prefix' => 'about-us'], function (){
            Route::get('/', 'AboutUsController@index');
            Route::post('submit', 'AboutUsController@submit');
        });

        Route::group(['prefix' => 'terms-and-conditions'], function (){
            Route::get('/', 'PolicyController@index');
            Route::post('submit', 'PolicyController@submit');
        });

        Route::group(['prefix' => 'social-media-links'], function (){
            Route::get('/', 'SocialMediaLinksController@index');
            Route::post('submit', 'SocialMediaLinksController@submit');
        });

        Route::group(['prefix' => 'newsletter-subscribers'], function (){
            Route::get('/', 'NewsLetterController@index');
            Route::get('{id}/status', 'NewsLetterController@status');
            Route::get('{id}/delete', 'NewsLetterController@delete');
        });

        Route::group(['prefix' => 'inquiries'], function (){
            Route::get('/', 'InquiryController@index');
            Route::get('{id}/delete', 'InquiryController@delete');
        });

        Route::group(['prefix' => 'customers'], function (){
            Route::get('/', 'CustomerController@index');
            Route::get('{id}/status', 'CustomerController@status');
        });

        Route::group(['prefix' => 'orders'], function (){
            Route::get('{status}', 'OrderController@index');
            Route::get('{id}/status/{oid}', 'OrderController@status');
            Route::get('{id}/delete', 'OrderController@delete');
        });

        Route::get('logout', 'LoginController@logout');
    });
});
