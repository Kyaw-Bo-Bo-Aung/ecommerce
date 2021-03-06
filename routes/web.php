<?php

use Illuminate\Support\Facades\Route;

// auth routes 
Auth::routes();
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

// backend routes 
Route::middleware('admin')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'AdminController@dashboard')->name('dashboard');
    Route::get('/profile/password-setting', 'AdminController@passwordSetting')->name('password-setting');
    Route::put('/profile/update-password', 'AdminController@updatePassword')->name('update-password');
    Route::get('/profile/profile-setting', 'AdminController@profileSetting')->name('profile-setting');
    Route::put('/profile/update-profile', 'AdminController@updateProfile')->name('update-profile');
    // section
    Route::get('/sections', 'SectionController@index')->name('sections');
    Route::post('/sections/update-status', 'SectionController@updateStatus');
    //categories
    Route::resource('/categories', 'CategoryController');
    Route::post('/categories/update-status', 'CategoryController@updateStatus');
    Route::get('/categories/data-tables/ssd', 'CategoryController@ssd');
    // subcategories
    Route::resource('/subcategories', 'SubcategoryController');
    Route::post('/subcategories/update-status', 'SubcategoryController@updateStatus');
    Route::get('/subcategories/data-tables/ssd', 'SubcategoryController@ssd');
    // products
    Route::resource('/products', 'ProductController');
    Route::post('/products/update-status', 'ProductController@updateStatus');
    Route::get('/products/data-tables/ssd', 'ProductController@ssd');
    Route::post('/products/get-relating-subcategory', 'ProductController@getRelatedSubcategory');
    Route::post('/products/attributes', 'ProductController@postAttributes')->name('products.post-attributes');
});
