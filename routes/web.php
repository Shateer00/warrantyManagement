<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::group(['middleware' => ['auth']], function() {

    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

    Route::group(['middleware' => ['verified']], function() {

        Route::get('/PDFGenerate/{id}', 'PDFController@PDFGenerate')->name('PDFGenerate');

        /**
         * Brand GET
         */
        Route::get('/brand', 'brandController@index')->name('brand');
        Route::get('/brand/search', 'brandController@search')->name('brand.search');
        Route::get('/brand/edit/{id}', 'brandController@edit')->name('brand.edit');

        /**
         * Brand POST
         */
        Route::post('/brand', 'brandController@add')->name('brand.add');
        Route::post('/brand/edit/{id}', 'brandController@editdetail')->name('brand.edit.detail');

        /**
         * Category GET
         */
        Route::get('/category', 'categoryController@index')->name('category');
        Route::get('/category/search', 'categoryController@search')->name('category.search');
        Route::get('/category/edit/{id}', 'categoryController@edit')->name('category.edit');

        /**
         * Category POST
         */
        Route::post('/category', 'categoryController@add')->name('category.add');
        Route::post('/category/edit/{id}', 'categoryController@editdetail')->name('category.edit.detail');

        /**
         * Model GET
         */
        Route::get('/model', 'modelController@index')->name('model');
        Route::get('/model/search', 'modelController@search')->name('model.search');
        Route::get('/model/edit/{id}', 'modelController@edit')->name('model.edit');

        /**
         * Model POST
         */
        Route::post('/model', 'modelController@add')->name('model.add');
        Route::post('/model/edit/{id}', 'modelController@editdetail')->name('model.edit.detail');

        /**
         * Warranty GET
         */
        Route::get('/warranty', 'warrantyController@index')->name('warranty');
        Route::get('/warranty/search/getmodel/', 'warrantyController@getModel')->name('warranty.getmodel');
        Route::get('/warranty/search', 'warrantyController@search')->name('warranty.search');
        Route::get('/warranty/edit/{id}', 'warrantyController@edit')->name('warranty.edit');
        Route::get('/warranty/view/{id}','warrantyController@view')->name('warranty.view');
        /**
         * Warranty POST
         */
        Route::post('/warranty/edit/{id}', 'warrantyController@editdetail')->name('warranty.edit.detail');
        Route::post('/warranty', 'warrantyController@add')->name('warranty.add');

        });
});

/**
 * Welcome Get
 */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/**
 * Home Get
 */
Route::get('/home', 'HomeController@index')->name('home');

