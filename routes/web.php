<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

use Auth;

//Users - Admin

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController',['except'=>['show','create','store']]);
});
 
//User

Route::group(['middleware'=>'auth', 'prefix'=> 'users'], function(){
    
    Route::get('/profile/', 'UserController@profile')->name('users.profile');
    
    Route::get('/analysis/', 'UserController@analysis')->name('users.analysis');
});


// Areas

Route::group(['middleware'=>'auth', 'prefix'=> 'areas'], function(){

    Route::get('/show/{area}', 'AreaController@show')->name('areas.show');
    
    Route::get('/create', 'AreaController@create')->name('areas.create');
    
    Route::get('/list/', 'AreaController@index')->name('areas.index');

    Route::delete('/delete/{id}/', 'AreaController@destroy')->name('areas.destroy');

    Route::post('/store/', 'AreaController@store')->name('areas.store');
});

// Offers

Route::group(['middleware'=>'auth', 'prefix'=> 'offers'], function(){

    Route::get('/cancel/{offer}', 'OfferController@cancel')->name('offers.cancel');
    
    Route::post('/addarea/{area}', 'OfferController@addarea')->name('offers.addarea');
    
    Route::get('/blockchain/{offer}', 'OfferController@blockchain')->name('offers.blockchain');

    Route::get('/show/{offer}', 'OfferController@show')->name('offers.show');

    Route::get('/showMyOffer/{offer}', 'OfferController@showMyOffer')->name('offers.showMyOffer');

    Route::get('/list', 'OfferController@index')->name('offers.index');

    Route::get('/create/{area}', 'OfferController@create')->name('offers.create');

    Route::post('/store/{area}', 'OfferController@store')->name('offers.store');

    Route::get('/buy/{offer}', 'OfferController@buy')->name('offers.buy');

    Route::post('/confirm/{offer}', 'OfferController@confirm')->name('offers.confirm');
  
});

//Comments

Route::group(['middleware'=>'auth', 'prefix'=> 'comments'], function(){
    
    Route::post('/create/{offer}', 'CommentController@create')->name('comments.create');
    
    Route::get('/show/{comment}', 'CommentController@show')->name('comments.show');
    
    Route::get('/edit/{comment}', 'CommentController@edit')->name('comments.edit');

    Route::post('/update/{comment}', 'CommentController@update')->name('comments.update');
    
    Route::get('/list', 'CommentController@index')->name('comments.index');

    Route::post('/store', 'CommentController@store')->name('comments.store');
    
    Route::delete('/delete/{id}', 'CommentController@destroy')->name('comments.destroy');
});


//Documents

Route::group(['middleware'=>'auth', 'prefix'=> 'documents'], function(){
    
    Route::get('/new/{document}', 'DocumentController@create')->name('documents.create');
    
    Route::get('/show/{offer}', 'DocumentController@show')->name('documents.show');
    
    Route::post('/store/{offer}', 'DocumentController@store')->name('documents.store');
    
});

// Property

Route::group(['middleware'=>'auth', 'prefix'=> 'properties'], function(){

    Route::get('/show/{property}', 'PropertyController@show')->name('properties.show');
    
    Route::get('/create', 'PropertyController@create')->name('properties.create');
    
    Route::get('/list', 'PropertyController@index')->name('properties.index');

    Route::delete('/delete/{id}', 'PropertyController@destroy')->name('properties.destroy');

    Route::post('/store', 'PropertyController@store')->name('properties.store');
});



Auth::routes();

Route::get('/','HomeController@index')->name('home');

Route::get('/home','HomeController@index')->name('home');


